<?php

namespace App\Http\Livewire\Card;

use App\Models\Platform;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    protected $queryString = ['code','keyword'];

    public $categories, $platforms, $countries, $country, $sort='asc', $code, $keyword;

    public $perPage = 12;

    public function mount(){
        $this->platforms = Platform::all();
//        $this->categories = Category::get(['id','name']);
//        $this->countries = Country::get(['id','name']);
    }

    public function render()
    {
        $products = Product::whereStatus(true);

        if($this->code){
            $products->whereHas('platform', function ($q){
                $q->where('slug', $this->code);
            });
        }

        if($this->keyword){
            $products->where('title','like','%'.$this->keyword.'%')->orWhere('description','like','%'.$this->keyword.'%');
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

        return view('livewire.card.home',[
            'cards' => $products->paginate($this->perPage)
        ]);
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function updatingCountry(){
        $this->resetPage();
    }
}
