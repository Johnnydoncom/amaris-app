<?php

namespace App\Http\Livewire\Card;

use App\Enums\ProductStatus;
use App\Models\Country;
use App\Models\DeliveryType;
use App\Models\MessageCategory;
use App\Models\MessageDesigns;
use App\Models\Product;
use App\Models\Variation;
use Illuminate\Session\SessionManager;
use Livewire\Component;

class Show extends Component
{
    public $product;
    public $gallery = [];
    public $related = [];


    public $popularAmounts;
    public $designCategories=[];
    public $deliveryTypes =[];
    public $countries;
    public $amount=0, $quantity=1, $design_category,$selected_design, $personal_message, $delivery_type='both', $delivery_address, $delivery_city, $delivery_state, $delivery_country, $recipient_name, $recipient_email, $recipient_phone;
    public $messageDesigns = [];
    public $variation, $variations;

    protected $rules = [
        'variation' => 'required',
        'quantity' => 'required|min:1'
    ];

    protected $messages = [
        'variation.required' => 'Select a card value to continue.'
    ];

    public function mount($slug){
        $this->product = Product::whereStatus(ProductStatus::PUBLISHED)->whereSlug($slug)->firstOrFail();
        $f = $this->product->getMedia('featured_image');

        $this->gallery[] = $f[0]->getUrl();
        $g = $this->product->getMedia('gallery');
        foreach($g as $key => $m){
            $this->gallery[$key+1] = $m->getUrl();
        }

        // Related products
        $this->related = Product::whereStatus(ProductStatus::PUBLISHED)->whereHas('categories', function ($q) {
            $q->whereIn('category_id', $this->product->categories->pluck('id'))->orWhereIn('category_id', $this->product->categories->pluck('parent_id'));
        })->where('id', '!=', $this->product->id)->inRandomOrder()->limit(4)->get();


        if($v = $this->product->variations()->first()){
            $this->variation = $v->id;
        }

        $this->variations = $this->product->variations->append('price');

        $this->popularAmounts = array(10,20,500,100,200,500);
        $this->countries = Country::all();
        $this->deliveryTypes = DeliveryType::get();
        $this->delivery_type = 'both';
    }

    public function render()
    {
        return view('livewire.card.show');
    }

    public function addToBasket(){
        return redirect()->route('cards.order.index', $this->product->slug);
    }


    public function save(SessionManager $sessionManager){
        $this->validate();

        $variation = Variation::find($this->variation);

        $sessionManager->put('cart', [
            'product' => $this->product->id,
            'variation' => $variation,
            'currency' => currency()->getUserCurrency(),
            'amount' => $this->quantity*$variation->price,
            'quantity' => $this->quantity
        ]);

        return redirect()->route('cards.checkout', $this->product->slug);
    }
}
