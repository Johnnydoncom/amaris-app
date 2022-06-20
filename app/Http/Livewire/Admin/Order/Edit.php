<?php

namespace App\Http\Livewire\Admin\Order;

use App\Enums\UserRole;
use App\Models\Order;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public Order $order;
    public $statuses=[], $customers=[], $delivery_address, $status;

    public function mount($order){
        $this->statuses = config('amaris.orderstatus');
        $this->customers = User::role([UserRole::CUSTOMER])->get();
        $this->delivery_address = $this->order->delivery_address;
        $this->status = $this->order->status;
    }

    public function render()
    {
        return view('livewire.admin.order.edit')->layout('layouts.admin');
    }

    public function update(){
        $this->validate(['status'=>'required']);
        $this->order->update([
            'status' => $this->status
        ]);

        // Set Flash Message
        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=>"Record Saved!"
        ]);
    }

    public function delete(){

        $this->order->delete();
        return redirect()->route('admin.orders.index');
    }
}
