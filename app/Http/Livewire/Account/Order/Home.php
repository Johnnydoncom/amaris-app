<?php

namespace App\Http\Livewire\Account\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.account.order.home',[
            'orders' =>  Order::whereUserId(auth()->user()->id)->paginate()
        ])->layout('layouts.account');
    }
}
