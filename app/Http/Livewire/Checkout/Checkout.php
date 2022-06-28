<?php

namespace App\Http\Livewire\Checkout;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\City;
use App\Models\Country;
use App\Models\DeliveryType;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\State;
use App\Models\Variation;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class Checkout extends Component
{
    public $cart;
    public $product;
    public $countries=[];
    public $subtotal, $total, $shippingCost, $payment_method, $payment_gateway, $currency, $discount_code, $variation, $quantity, $stripe_session, $p, $session_id, $first_name, $last_name, $email, $phone, $company, $address_line_1, $address_line_2, $city, $state, $country, $zipcode;

    public $states=[];
    public $cities=[];

    protected $queryString = ['session_id','p'];

    protected $rules = [
        'first_name' => ['required'],
        'last_name' => ['required'],
        'phone' => ['required'],
        'address_line_1' => ['required'],
        'state' => ['required'],
        'city' => ['required']
    ];

    public function mount(SessionManager $sessionManager){
        $this->first_name = Auth::user()->first_name;
        $this->last_name = Auth::user()->last_name;
        $this->email = Auth::user()->email;
        $this->phone = Auth::user()->phone;

        $this->cart = $sessionManager->get('cart');
        $this->countries = Country::get();

        $clientIP = request()->getClientIp();
        $location = geoip($clientIP)->toArray();
        if($country = Country::where('iso2', $location['iso_code'])->first()) {
            $this->country = $country->id;
            $this->states = $country->states;
        }

        $this->product = Product::default()->findOrFail($this->cart['product']);

        $this->quantity = $this->cart['quantity'];

        $this->subtotal = currency($this->cart['quantity']*$this->product->regular_price,null,null,false);
        $this->shippingCost = 0;
        $this->total = $this->subtotal + $this->shippingCost;

        $this->payment_method = 'card';

        $this->currency = currency()->getUserCurrency();

        if($this->currency == 'NGN'){
            $this->payment_gateway = 'paystack';
        }else{
            $this->payment_gateway = 'stripe';
            $this->stripe_session = $this->createStripeToken();
        }

        if($this->session_id){
            $sess = $this->retrieveStripeSession($this->session_id);
            if($sess && $sess['payment_status'] == 'paid' && $sess['status'] != 'expired'){
                $this->payment_gateway = 'stripe';
               $this->finalize($sess['payment_intent']);

            }
        }
    }

    public function render()
    {
        return view('livewire.checkout.checkout');
    }

    public function updatedCountry($country)
    {
        $this->states = State::whereCountryId($country)->get();
    }

    public function updatedState($state)
    {
        $this->cities = City::whereStateId($state)->get();
    }

    public function finalize($reference=null){

        $address = auth()->user()->delivery_addresses()->create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'company' => $this->company,
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_1,
            'country_id' => $this->country,
            'state_id' => $this->state,
            'city_id' => $this->city,
            'zipcode' => $this->zipcode
        ]);


        $order = new Order();
        $order->grand_total = $this->total;
        $order->user_id = auth()->user()->id;
        $order->payment_method = $this->payment_gateway;
        $order->delivery_address_id = $address->id;
        $order->item_count = 1;
        $order->shipping_charges = $this->shippingCost;
        $order->status = 'pending';
        $order->discount_code = $this->discount_code;
        $order->payment_reference = generateUniqueReferenceNumber();
        $order->currency = currency()->getUserCurrency();
        $order->payment_expires_at = Carbon::now()->addMinutes(15);

        if($reference) {
            $order->payment_status = PaymentStatus::PAID();
            $order->status = OrderStatus::PROCESSING;
            $order->payment_reference = $reference;
        }

        $order->payment_method = $this->payment_gateway;

        $order->save();

        $orderItem = new OrderItem();
        $orderItem->order_id = $order->id;
        $orderItem->product_id = $this->product->id;
        $orderItem->quantity = $this->cart['quantity'];

        $orderItem->value = $this->product->price;
        $orderItem->final_amount = currency($this->total,null,null,false);
        $orderItem->currency = currency()->getUserCurrency();
        $orderItem->save();

        session()->forget(['cart']);

//        $this->expireStripeSession();

        $url = URL::temporarySignedRoute('checkout.success', now()->addMinutes(1), ['order' => $order->id]);
        session()->flash('success', 'Order Placed');
        return redirect()->route('account.order.show', $order->order_number);
    }

    public function retrieveStripeSession($session_id){
        $stripe = new \Stripe\StripeClient(
            setting('stripe_secret')
        );
        return $stripe->checkout->sessions->retrieve(
            $session_id,
            []
        );
    }

    public function createStripeToken(){
        \Stripe\Stripe::setApiKey(setting('stripe_secret'));
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $this->product->title,
                    ],
                    'unit_amount' => $this->product->price*100,
                ],
                'quantity' => $this->quantity,
            ]],
            'mode' => 'payment',
            'success_url' => route('order.checkout') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('order.checkout', $this->product->slug),
        ]);
        return $session->id;
    }

    public function expireStripeSession(){
        if($this->session_id) {
            $stripe = new \Stripe\StripeClient(
                setting('stripe_secret')
            );
            $stripe->checkout->sessions->expire(
                $this->session_id,
                []
            );
        }
    }
}
