<?php

namespace App\Http\Livewire\Account;

use App\Models\Country;
use App\Models\User;
use App\Models\UserVerification;
use App\Models\VerificationType;
use App\Traits\VerificationServices;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class Home extends Component
{
    use WithFileUploads, VerificationServices;

    public $user;
    public $verificationTypes;
    public $countries=[];
    public $avatar;
    public $verified = false;

    public $last_name, $first_name, $email, $phone, $dob, $address, $city, $zipcode, $verification_record;

    protected $rules = [
        'avatar' => 'image|max:1024'
    ];

    public function mount(){
        $this->user = User::find(auth()->user()->id);
        $this->countries = Country::get(['id','name']);

        $this->last_name = auth()->user()->last_name;
        $this->first_name = auth()->user()->first_name;
        $this->email = auth()->user()->email;
        $this->phone = auth()->user()->phone;
        $this->dob = auth()->user()->dob;

        $this->verification_record = auth()->user()->verifications()->latest()->first();
    }

    public function updatedAvatar(){
        if($this->avatar) {
            auth()->user()
                ->addMedia($this->avatar->getRealPath())
                ->toMediaCollection('avatar');

            $this->reset(['avatar']);
        }
    }

    public function render()
    {
//        auth()->user()->deposit(1000);

        return view('livewire.account.home');
    }

    public function update(){
        $this->validate([
           'last_name' => 'required',
           'first_name' => 'required',
           'dob' => 'required',
            'phone' => 'required'
        ]);

        $user = User::find(auth()->user()->id);
        $user->last_name = $this->last_name;
        $user->first_name = $this->first_name;
        $user->save();

        // Set Flash Message
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Record Saved!"
        ]);
    }
}
