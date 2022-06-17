<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Category;
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
    public $categories;
    public $countries = [];
    public $images = [];
    public $image;
    public $updateMode = false;

    public $variations = [];

    public $product_id, $title, $description, $category_id, $stock_quantity, $featured, $slug, $regular_price, $sales_price=0, $product_type, $type, $status, $sku, $manage_stock;

    public function mount(){
        $this->categories = Category::get();

        if($this->product){
            $this->title = $this->product->title;
            $this->slug = $this->product->slug;
            $this->description = $this->product->description;
            $this->featured = $this->product->featured;
            $this->category_id = $this->product->category_id;
//            $this->subtitle = $this->product->subheading;

            $this->stock_quantity = $this->product->stock_quantity;
            $this->regular_price = $this->product->regular_price;
            $this->sales_price = $this->product->sales_price;
            $this->status = $this->product->status ? 1 : 0;

        }else{
            $this->status = 0;
            $this->featured = false;
        }
    }


    public function render()
    {
        return view('livewire.admin.product.form');
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
            'category_id' => 'required',
            'regular_price' => 'required',
            'image' => 'image|max:1024|nullable',
            'slug' => ['required','unique:products,slug,'. (!is_null($this->product) ? $this->product->id : '')]
        ]);

        $product = $this->product ?? new Product();
        $product->title = $this->title;
        $product->slug = $this->slug;
        $product->regular_price = $this->regular_price;
        $product->sales_price = $this->sales_price;
        $product->stock_quantity = $this->stock_quantity ?? null;
        $product->description = $this->description;
        $product->product_type = 'default';
        $product->featured = $this->featured ? 1 : 0;
        $product->category_id = $this->category_id;
        if(!$this->product) {
            $product->user_id = auth()->user()->id;
        }
        $product->save();


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
            $this->reset(['title','description','image', 'images', 'category_id', 'regular_price', 'sales_price', 'stock_quantity', 'featured']);

        $this->reset(['images']);

        // Set Flash Message
        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=>"Product Created Successfully!!"
        ]);
        if(!$this->product)
            return redirect()->route('admin.products.index');
    }

    public function removeGallery($key){
        unset($this->images[$key]);
    }

    public function removeGalleryById($id)
    {
        Media::find($id)->delete();
        $this->product = Product::find($this->product->id);
//        unset($this->images[$id]);
    }
}
