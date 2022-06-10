<?php

namespace App\Http\Livewire\Product;

use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    public $categories, $countries, $country, $sort='asc', $search;

    public $perPage = 12;

    public function mount(){
        $this->categories = Category::get(['id','name']);
        $this->countries = Country::get(['id','name']);
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function updatingCountry(){
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::whereStatus(true);

        if($this->search){
            $products->where('title','like','%'.$this->search.'%')->orWhere('description','like','%'.$this->search.'%');
        }

        if($this->country){
            $products->whereJsonContains('redemption_country_ids', $this->country);
        }

        if($this->sort){
            switch ($this->sort){
                case 'new':
                    $products->latest();
                    break;

                case 'popular':
                    $products->orderBy('views_count', 'desc');
                    break;

                case 'asc':
                    $products->orderBy('title', 'asc');
                    break;

                default:
                    $products->orderBy('title', 'desc');
            }
        }


        return view('livewire.product.home',[
            'products' => $products->paginate($this->perPage)
        ]);
    }
}
