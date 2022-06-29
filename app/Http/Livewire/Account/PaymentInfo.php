<?php

namespace App\Http\Livewire\Account;

use App\Models\Country;
use App\Models\PaymentInformation;
use Livewire\Component;

class PaymentInfo extends Component
{
    public $payment_information, $countries=[], $bank_name, $bank_account_no, $bank_account_name, $bank_swift_code, $bank_branch, $country_id;
    public $editing = false;

    public function mount(){
        $this->payment_information = auth()->user()->payment_information ? auth()->user()->payment_information->load('country') : null;
        $this->countries = Country::get(['id','name']);

        if($this->payment_information){
            $this->bank_name = $this->payment_information->bank_name;
            $this->bank_account_no = $this->payment_information->bank_account_no;
            $this->bank_account_name = $this->payment_information->bank_account_name;
            $this->bank_swift_code = $this->payment_information->bank_swift_code;
            $this->bank_branch = $this->payment_information->bank_branch;
            $this->country_id = $this->payment_information->country_id;
        }
    }

    public function render()
    {
        return view('livewire.account.payment-info')->layout('layouts.account');
    }

    public function save(){
        $this->validate([
            'bank_name' => ['required'],
            'bank_account_no' => ['required'],
            'bank_account_name' => ['required'],
            'country_id' => ['required']
        ]);

        $paymentInformation = $this->payment_information ?? new PaymentInformation();
        $paymentInformation->bank_name = $this->bank_name;
        $paymentInformation->bank_account_no = $this->bank_account_no;
        $paymentInformation->bank_account_name = $this->bank_account_name;
        $paymentInformation->bank_swift_code = $this->bank_swift_code;
        $paymentInformation->bank_branch = $this->bank_branch;
        $paymentInformation->country_id = $this->country_id;
        $paymentInformation->user_id = auth()->user()->id;
        $paymentInformation->save();

        $this->editing = false;

        session()->flash('success', 'Your information has been saved');
    }
}
