<?php

namespace App\Http\Livewire\Account\Order;

use App\Enums\PaymentStatus;
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
    public function finalize($reference){
        if($reference) {
            $order = $this->order;
            $order->payment_status = PaymentStatus::PAID;
            $order->status = 'processing';
            $order->payment_reference = $reference;
            $order->save();

            session()->flash('success', 'Payment Successful!');
        }
    }
}
