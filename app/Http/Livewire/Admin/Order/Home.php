<?php

namespace App\Http\Livewire\Admin\Order;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.admin.order.home')->layout('layouts.admin');
    }
}
