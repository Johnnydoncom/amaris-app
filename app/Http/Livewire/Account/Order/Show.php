<?php

namespace App\Http\Livewire\Account\Order;

use App\Enums\PaymentStatus;
use App\Events\CommissionEarned;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
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

            if (Cookie::get('affiliate')) {
                $ref = User::where('account_id', Cookie::get('affiliate'))->first();
                if ($ref && setting('referral_commission') > 0) {
                    $commission = (setting('referral_commission')/100)*$this->order->grand_total;
                    $tx = $ref->deposit($commission*$this->order->items[0]->quantity, ['type' => 'order_commission', 'description' => 'Commission for referring '.$this->order->user->name.' to buy "'.$this->order->product->title.'"', 'product_id' => $this->order->product->id]);
                    CommissionEarned::dispatch($tx);
                }
                Cookie::forget('affiliate');
            }

            session()->flash('success', 'Payment Successful!');
        }
    }
}
