<?php

namespace App\Http\Livewire\Admin;

use App\Models\Country;
use Livewire\Component;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;

    public $countries=[], $settings=[], $states=[];
    public $site_name,$site_email,$site_phone, $site_currency_name, $site_currency_code, $logo, $lightLogo, $site_description, $site_footer_text, $paystack_secret, $paystack_key, $paystack_mode, $paystack_active, $stripe_secret, $stripe_key, $stripe_active, $verifyafrica_userid, $verifyafrica_dvl_key, $verifyafrica_nin_key, $verifyafrica_voters_key, $verifyafrica_passport_key, $twilio_sid, $twilio_auth_token, $open_exchange_api, $referral_commission, $min_commission_withdrawal;
    public $logoUpload, $site_logo, $lightLogoUpload;

    public function mount(){
        $this->countries = Country::whereActive(true)->get();
        $country = Country::where('name', 'nigeria')->first();
        $this->states = $country->states()->get()->map(function($city){
            return [
                'value' => $city->id,
                'label' => ucfirst($city->name)
            ];
        });

        $this->site_name = setting('site_name');
        $this->site_email = setting('site_email');
        $this->site_phone = setting('site_phone');
        $this->site_currency_name = setting('site_currency_name');
        $this->site_currency_code = setting('site_currency_code');
        $this->site_description = setting('site_description');
        $this->site_footer_text = setting('site_footer_text');
        $this->paystack_secret = setting('paystack_secret');
        $this->paystack_key = setting('paystack_key');
        $this->paystack_mode = setting('paystack_mode');
        $this->paystack_active = setting('paystack_active');
        $this->stripe_secret = setting('stripe_secret');
        $this->stripe_key = setting('stripe_key');
        $this->stripe_active = setting('stripe_active');
        $this->verifyafrica_userid = setting('verifyafrica_userid', env('VERIFYAFRICA_USERID'));
        $this->verifyafrica_dvl_key = setting('verifyafrica_dvl_key', env('VERIFYAFRICA_DRIVERS_LICENSE_KEY'));
        $this->verifyafrica_nin_key = setting('verifyafrica_nin_key', env('VERIFYAFRICA_NIN_KEY'));
        $this->verifyafrica_voters_key = setting('verifyafrica_voters_key', env('VERIFYAFRICA_VOTERS_CARD_KEY'));
        $this->verifyafrica_passport_key = setting('verifyafrica_passport_key', env('VERIFYAFRICA_INTL_PASSPORT_KEY'));
        $this->twilio_sid = setting('twilio_sid', env('TWILIO_ACCOUNT_SID'));
        $this->twilio_auth_token = setting('twilio_auth_token', env('TWILIO_AUTH_TOKEN'));
        $this->open_exchange_api = setting('open_exchange_api', env('OPEN_EXCHANGE_RATE_KEY'));
        $this->min_commission_withdrawal = setting('min_commission_withdrawal');
        $this->referral_commission = setting('referral_commission');

    }

    public function render()
    {
        return view('livewire.admin.settings')->layout('layouts.admin');
    }

    public function save(){
        $this->validate([
            'logoUpload' => 'nullable | image',
            'site_name' => 'nullable'
        ]);

        $settingArray = [];

        $settingArray['site_name'] = $this->site_name;
        $settingArray['site_email'] = $this->site_email;
        $settingArray['site_phone'] = $this->site_phone;
        $settingArray['site_currency_name'] = $this->site_currency_name;
        $settingArray['site_currency_code'] = $this->site_currency_code;
        $settingArray['site_description'] = $this->site_description;
        $settingArray['site_footer_text'] = $this->site_footer_text;
        $settingArray['paystack_secret'] = $this->paystack_secret;
        $settingArray['paystack_key'] = $this->paystack_key;
        $settingArray['paystack_mode'] = $this->paystack_mode;
        $settingArray['paystack_active'] = $this->paystack_active;
        $settingArray['stripe_secret'] = $this->stripe_secret;
        $settingArray['stripe_key'] = $this->stripe_key;
        $settingArray['stripe_active'] = $this->stripe_active;
        $settingArray['verifyafrica_userid'] = $this->verifyafrica_userid;
        $settingArray['verifyafrica_dvl_key'] = $this->verifyafrica_dvl_key;
        $settingArray['verifyafrica_nin_key'] = $this->verifyafrica_nin_key;
        $settingArray['verifyafrica_voters_key'] = $this->verifyafrica_voters_key;
        $settingArray['verifyafrica_passport_key'] = $this->verifyafrica_passport_key;
        $settingArray['twilio_sid'] = $this->twilio_sid;
        $settingArray['twilio_auth_token'] = $this->twilio_auth_token;
        $settingArray['open_exchange_api'] = $this->open_exchange_api;
        $settingArray['referral_commission'] = $this->referral_commission;
        $settingArray['min_commission_withdrawal'] = $this->min_commission_withdrawal;

        if($this->logo) {
            $settingArray['site_logo'] = $this->logo->storePublicly('/', 'public');
        }

        if($this->lightLogo) {
            $settingArray['site_logo_white'] = $this->lightLogo->storePublicly('/', 'public');
        }

        \Setting::set($settingArray);
        \Setting::save();

        // Set Flash Message
        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=>"Settings Saved!!!"
        ]);
    }
}
