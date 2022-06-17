<?php

namespace App\Http\Livewire\Admin\Product;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.admin.product.home')->layout('layouts.admin');
    }
}
