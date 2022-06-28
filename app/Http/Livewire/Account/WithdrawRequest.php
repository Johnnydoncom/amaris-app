<?php

namespace App\Http\Livewire\Account;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Validator;
use Livewire\Component;

class WithdrawRequest extends Component
{
    public $payment_information, $amount;

    protected $rules = [
        'amount'=>'required'
    ];

    public function mount(){
        if(! Gate::allows('withdraw-commission')) {
            abort(403);
        }

        $this->payment_information = auth()->user()->payment_information ? auth()->user()->payment_information->load('country') : null;
    }

    public function render()
    {
        return view('livewire.account.withdraw-request')->layout('layouts.account');
    }

    public function withdraw(){
//        $this->validate();

        $this->withValidator(function (Validator $validator) {
            $validator->after(function ($validator) {

                // Check for pending transaction
                if($withdrawExist = auth()->user()->withdraws()->where('status', \App\Enums\WithdrawStatus::PENDING())->first()){
                    $validator->errors()->add( 'exist','You have a pending withdrawal requests');
                }

                if($this->amount < setting('min_commission_withdrawal')){
                    $validator->errors()->add( 'amount','Requested amount is below the minimum withdrawal amount ('.app_money_format(setting('min_commission_withdrawal')).')');
                }

                if(!auth()->user()->payment_information){
                    $validator->errors()->add( 'payment_information', 'Payment information is required to request withdrawal of commission.');
                }

            });

        })->validate();


        $tx = auth()->user()->withdraw((float)$this->amount, ['description' => 'Referral Commission withdrawal'], false);
        auth()->user()->wallet->refreshBalance();

        $withdrawRequest = new \App\Models\WithdrawRequest();
        $withdrawRequest->user_id = auth()->user()->id;
        $withdrawRequest->amount = (float)$this->amount;
        $withdrawRequest->transaction_id = $tx->id;
        $withdrawRequest->save();

        $admins = User::role(UserRole::ADMIN())->get();
        Notification::send($admins, new \App\Notifications\WithdrawRequest($withdrawRequest));
        session()->flash('success', 'Your information has been saved');

        $this->reset(['amount']);
    }
}
