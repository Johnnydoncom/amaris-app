<?php

namespace App\Http\Livewire\Account\Order;

use App\Models\Order;
use Livewire\Component;

class Show extends Component
{
    public $order;

    public function mount($order_number){
        $this->order = Order::whereUserId(auth()->user()->id)->whereOrderNumber($order_number)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.account.order.show')->layout('layouts.account');
    }
}
