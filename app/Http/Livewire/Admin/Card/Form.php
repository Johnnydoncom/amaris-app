<?php

namespace App\Http\Livewire\Admin\Card;

use App\Models\Country;
use App\Models\Media;
use App\Models\Platform;
use App\Models\Product;
use App\Models\Variation;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $product;
    public $tags = [];
    public $sticky = false;
    public $platforms;
    public $countries = [];
    public $images = [];
    public $image;
    public $updateMode = false;
    public $inputs = [];
    public $i = 1;

    public $variations = [];

    public $product_id, $title, $subtitle, $description, $platform_id, $stock_quantity, $featured, $slug, $country_id, $variation_name, $regular_price, $sales_price=0, $product_type, $type, $stock_status, $commission, $status, $sku, $manage_stock;

    public function mount(){
        $this->platforms = Platform::get();
        $this->countries = Country::all();

        if($this->product){
            $this->title = $this->product->title;
            $this->slug = $this->product->slug;
            $this->description = $this->product->description;
            $this->featured = $this->product->featured;
            $this->platform_id = $this->product->platform_id;
            $this->subtitle = $this->product->subheading;

            $this->stock_quantity = $this->product->stock_quantity;
            $this->regular_price = $this->product->regular_price;
            $this->sales_price = $this->product->sales_price;
            $this->country_id = $this->product->country_id;
            $this->status = $this->product->status ? 1 : 0;

            // Variations
            $this->inputs = $this->product->variations->map(function ($item){
                return [
                    'id' => $item->id,
                    'regular_price'=> $item->regular_price,
                    'sales_price'=> $item->sales_price,
                    'stock_quantity'=> $item->quantity,
                    'variation_name'=> $item->name,
                ];
            });

        }else{
            $this->status = 0;
            $this->featured = false;

            $this->inputs[] = array(
                'variation_name' => null,
                'regular_price' => null,
                'sales_price' => null,
                'stock_quantity' => null
            );
        }
    }


    public function render()
    {
        return view('livewire.admin.card.form');
    }

    public function updatedTitle()
    {
        $this->slug = SlugService::createSlug(Product::class, 'slug', $this->title);
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function add()
    {
        $this->inputs[] = array(
            'variation_name' => null,
            'regular_price' => null,
            'sales_price' => null,
            'stock_quantity' => null
        );
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove($i)
    {
        if(isset($this->inputs[$i]['id'])){
            Variation::find($this->inputs[$i]['id'])->delete();
        }
        unset($this->inputs[$i]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    private function resetInputFields(){
        $this->variation_name = '';
        $this->regular_price = '';
        $this->sales_price = 0;
        $this->stock_quantity = null;
    }

    public function store(){
        $this->validate([
            'title' => 'required|min:6',
            'description' => 'required|min:5',
            'platform_id' => 'required',
            'inputs.*.regular_price' => 'required',
            'country_id' => 'required',
            'inputs' => 'required',
            'image' => 'image|max:1024|nullable',
            'slug' => ['required','unique:products,slug,'. (!is_null($this->product) ? $this->product->id : '')]
        ]);

        $product = $this->product ?? new Product();
        $product->title = $this->title;
        $product->slug = $this->slug;
        $product->subheading = $this->subtitle;
        $product->stock_quantity = $this->stock_quantity ?? null;
        $product->description = $this->description;
        $product->product_type = 'gift_card';
        $product->featured = $this->featured ? 1 : 0;
        $product->country_id = $this->country_id;
        $product->platform_id = $this->platform_id;
        if(!$this->product) {
            $product->user_id = auth()->user()->id;
        }
        $product->save();

        // Variations
        if($this->inputs) {
            foreach ($this->inputs as $key => $variation) {
                if (isset($variation['variation_name']) && isset($variation['regular_price']) && isset($variation['id'])) {
                    Variation::find($variation['id'])->update([
                        'name' => $variation['variation_name'],
                        'regular_price' => $variation['regular_price'],
                        'sales_price' => $variation['sales_price'] ?? 0,
                        'quantity' => $variation['stock_quantity'] ?? null
                    ]);
                }elseif (isset($variation['variation_name']) && isset($variation['regular_price'])){
                    Variation::create([
                        'name' => $variation['variation_name'],
                        'regular_price' => $variation['regular_price'],
                        'sales_price' => $variation['sales_price'] ?? 0,
                        'quantity' => $variation['stock_quantity'] ?? null,
                        'product_id' => $product->id
                    ]);
                }
            }
        }

        if($this->image)
            $product
                ->addMedia($this->image->getRealPath())
                ->toMediaCollection('featured_image');

        // Add gallery
        if($this->images) {
            foreach ($this->images as $image) {
                $product
                    ->addMedia($image->getRealPath())
                    ->toMediaCollection('gallery');
            }
        }

        if(!$this->product)
            $this->reset(['title','subtitle','description','image', 'images', 'platform_id', 'regular_price', 'sales_price', 'stock_quantity', 'featured']);

        // Set Flash Message
        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=>"Product Created Successfully!!"
        ]);
        if(!$this->product)
            return redirect()->route('admin.cards.index');
    }

    public function removeGallery($key){
        unset($this->images[$key]);
    }

    public function removeGalleryById($id){
        Media::find($id)->delete();
        $this->product = Product::find($this->product->id);
//        unset($this->images[$id]);
    }

    public function addAttribute(){
        if($this->selAttribute == 'custom'){
            $this->pattributes[] = array(
                'name'=> null,
                'value'=> null,
                'type'=> 'custom',
                'code'=>null,
                'id'=>null
            );
        }else {
            $att = $this->allAttributes->where('code', $this->selAttribute)->first();
            if(!collect($this->pattributes)->where('code', $att->code)->first()) {
                $this->pattributes[] = array(
                    'name' => $att->name,
                    'value' => null,
                    'type' => null,
                    'code' => $att->code,
                    'id' => $att->id
                );
            }
        }

        $this->emitSelf('attributeSelected');
        $this->dispatchBrowserEvent('attribute-selected');

    }

    public function removeAttribute($index){
        unset($this->pattributes[$index]);
    }

    public function addVariation(){
        $attr = collect($this->pattributes)->where('code', 'size')->first();
        if($attr){
            foreach ($attr['value'] as $k => $v){
                $this->variations[] = array(
                    'sku' => null,
                    'regular_price' => null,
                    'sales_price'=> null,
                    'stock_quantity'=> null,
                    'attribute'=> $attr['name'],
                    'attribute_code' => $attr['code'],
                    'attribute_value' => $v
                );
            }
        }
    }
}
