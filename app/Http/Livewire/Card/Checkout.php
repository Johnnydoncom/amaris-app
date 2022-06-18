<?php

namespace App\Http\Livewire\Card;

use App\Enums\PaymentStatus;
use App\Models\DeliveryType;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Variation;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class Checkout extends Component
{
    public $cart;
    public $product;
    public $subtotal, $total, $shippingCost, $payment_method, $payment_gateway, $currency, $discount_code, $variation, $quantity, $stripe_session, $p, $session_id;

    protected $queryString = ['session_id','p'];

    public function mount(SessionManager $sessionManager){
        $this->cart = $sessionManager->get('cart');

        $this->product = Product::findOrFail($this->cart['product']);
        $this->variation = Variation::findOrFail($this->cart['variation']->id);

        $this->quantity = $this->cart['quantity'];

        $this->subtotal = currency($this->cart['quantity']*$this->variation->price,null,null,false);
        $this->shippingCost = 0;
        $this->total = $this->subtotal + $this->shippingCost;
//        echo $this->total;
//        exit();

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
        return view('livewire.card.checkout');
    }

    public function finalize($reference=null){
        $order = new Order();
        $order->grand_total = $this->total;
        $order->user_id = auth()->user()->id;
        $order->payment_method = $this->payment_gateway;
        $order->item_count = 1;
        $order->shipping_charges = $this->shippingCost;
        $order->status = 'pending';
        $order->discount_code = $this->discount_code;
        $order->payment_reference = generateUniqueReferenceNumber();
        $order->currency = currency()->getUserCurrency();

        if($reference) {
            $order->payment_status = PaymentStatus::PAID;
            $order->status = 'processing';
            $order->payment_reference = $reference;
        }

        $order->payment_method = $this->payment_gateway;

        $order->save();

        $orderItem = new OrderItem();
        $orderItem->order_id = $order->id;
        $orderItem->product_id = $this->product->id;
        $orderItem->quantity = $this->cart['quantity'];
        $orderItem->variation_id = $this->variation->id;
        $orderItem->value = currency($this->variation->price, null,null,false);
        $orderItem->final_amount = currency($this->total,null,null,false);
        $orderItem->currency = currency()->getUserCurrency();
        $orderItem->save();

        session()->forget(['cart']);

//        $this->expireStripeSession();

        $url = URL::temporarySignedRoute('checkout.success', now()->addMinutes(1), ['order' => $order->id]);
        session()->flash('success', 'Order Placed');
        return redirect()->to($url);
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
                        'name' => $this->variation->name,
                    ],
                    'unit_amount' => $this->variation->price*100,
                ],
                'quantity' => $this->quantity,
            ]],
            'mode' => 'payment',
            'success_url' => route('cards.checkout', $this->product->slug) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('cards.checkout', $this->product->slug),
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
