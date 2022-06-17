<?php

namespace App\Http\Livewire\Admin\Card;

use Livewire\Component;
use App\Models\Product;

class Edit extends Component
{
    public Product $product;

    public function mount(){

    }

    public function render()
    {
        return view('livewire.admin.card.edit')->layout('layouts.admin');
    }
}
