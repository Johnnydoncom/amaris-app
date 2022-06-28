<?php

namespace App\Http\Livewire\Admin\Affiliate;

use App\Models\WithdrawRequest;
use Bavix\Wallet\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class Withdraws extends Component
{
    use WithPagination;

    public $viewing;

    public function render()
    {
        return view('livewire.admin.affiliate.withdraws')->with([
            'withdraws' => WithdrawRequest::paginate()
        ])->layout('layouts.admin');
    }

    public function viewRequest($id){
        $this->viewing = WithdrawRequest::findOrFail($id);
    }

    public function deleteRequest($id){
        WithdrawRequest::find($id)->delete();
        // Set Flash Message
        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=>"Request Deleted!!"
        ]);
    }
}
