<?php

namespace App\Http\Livewire\Checkout;

use App\Models\Country;
use App\Models\DeliveryType;
use App\Models\MessageCategory;
use App\Models\MessageDesigns;
use App\Models\Product;
use Illuminate\Session\SessionManager;
use Livewire\Component;

class Order extends Component
{
    public $product;
    public $popularAmounts;
    public $designCategories=[];
    public $deliveryTypes =[];
    public $countries;
    public $amount,$design_category,$selected_design, $personal_message, $delivery_type='email', $delivery_address, $delivery_city, $delivery_state, $delivery_country, $email_recipient_name, $email_recipient_email, $email_recipient_phone;
    public $messageDesigns = [];

    protected $rules = [
        'amount' => 'required',
        'selected_design' => 'required',
        'delivery_type' => 'required',
        'delivery_address' => 'required_if:delivery_type,delivery',
        'delivery_city' => 'required_if:delivery_type,delivery',
        'delivery_state' => 'required_if:delivery_type,delivery',
        'delivery_country' => 'required_if:delivery_type,delivery',
        'email_recipient_name' => 'required_if:delivery_type,email',
        'email_recipient_email' => 'required_if:delivery_type,email',
    ];

    public function mount($slug){
        $this->product = Product::whereSlug($slug)->firstOrFail();
        $this->designCategories = MessageCategory::get(['id','name']);

        $this->messageDesigns = MessageDesigns::all();

        $this->popularAmounts = array(500,1000,5000,10000,20000,50000);
        $this->countries = Country::all();

        $this->selected_design = $this->messageDesigns->first()->id;

        $this->deliveryTypes = DeliveryType::get();

        $this->delivery_type = 'email';
    }

    public function updatingDesignCategory($cat){
        $this->messageDesigns = MessageDesigns::whereMessageCategoryId($cat)->get();
    }

    public function render()
    {
        return view('livewire.checkout.order');
    }

    public function save(SessionManager $sessionManager){
        $this->validate();

        $sessionManager->put('cart', [
           'product' => $this->product->id,
           'currency' => currency()->getUserCurrency(),
           'amount' => $this->amount,
           'selected_design' => $this->selected_design,
            'personal_message' => $this->personal_message,
            'delivery_type' => $this->delivery_type,
            'delivery_address' => $this->delivery_address,
            'delivery_city' => $this->delivery_city,
            'delivery_state' => $this->delivery_state,
            'delivery_country' => $this->delivery_country,
            'email_recipient_name' => $this->email_recipient_name,
            'email_recipient_email' => $this->email_recipient_email,
            'email_recipient_phone' => $this->email_recipient_phone
        ]);

        return redirect()->route('order.checkout');
    }
}
