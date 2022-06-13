<?php

namespace App\Http\Livewire\Admin\ProductCategory;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination, WithFileUploads;

    public $category, $name, $image;

    protected $rules = [
        'name' => 'required'
    ];

    public function render()
    {
        return view('livewire.admin.product-category.home')->with([
            'categories' => Category::withCount('products')->paginate()
        ])->layout('layouts.admin');
    }

    public function editCategory($id){
        $this->category = Category::find($id);
        $this->name = $this->category->name;
    }

    public function store(){
        $this->validate();

        $category = $this->category ?? new Category();
        $category->name = $this->name;
        $category->save();

        if($this->image){
            $category
                ->addMedia($this->image->getRealPath())
                ->toMediaCollection('featured_image');
        }

        if(!$this->category)
            $this->reset(['name']);

        // Set Flash Message
        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=>"Record Saved!"
        ]);
    }

    public function deleteCategory($id){
        $this->category = Category::find($id)->delete();

        $this->dispatchBrowserEvent('alert',[
            'type'=>'error',
            'message'=>"Record Deleted!"
        ]);
    }

    public function resetForm(){
        $this->reset();
    }
}
