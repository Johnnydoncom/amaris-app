<?php

namespace App\Http\Livewire\Account;

use App\Enums\VerificationTypes;
use App\Models\Country;
use App\Models\User;
use App\Models\UserVerification;
use App\Models\VerificationType;
use App\Traits\VerificationServices;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Verification extends Component
{
    use WithFileUploads, VerificationServices;

    public $verification_record, $address_verification_record;

    public $verificationTypes;
    public $verifyType;
    public $frontId, $backId, $utilityBill;
    public $verified = false;
    public $id_no,$vin, $phone;
    public $verificationData = [];

    protected $rules = [
        'id_no' => 'required',
        'frontId' => 'required|image'
    ];

    public function mount(){
        $this->user = User::find(auth()->user()->id);
        $this->verificationTypes = VerificationType::all();
        $this->verifyType = $this->verificationTypes->first()->id;
        $this->countries = Country::get(['id','name']);

        $this->last_name = auth()->user()->last_name;
        $this->first_name = auth()->user()->first_name;
        $this->dob = auth()->user()->dob;
        $this->phone = auth()->user()->phone;

    }

    public function updatedVerifyType(){
        $this->reset(['id_no']);
    }

    public function render()
    {
        $this->verification_record = auth()->user()->verifications()->whereHas('verification_type', function ($query){
            $query->where('slug', '!=', Str::slug(VerificationTypes::ADDRESS()));
        })->where('status','pending')->latest()->first();
        if($this->verification_record){
            $this->verifyType =  $this->verification_record->verification_type_id;
            $this->id_no =  $this->verification_record->id_no;
        }

        $this->address_verification_record = auth()->user()->verifications()->whereHas('verification_type', function ($query){
            $query->where('slug', Str::slug(VerificationTypes::ADDRESS()));
        })->where('status','pending')->latest()->first();

        return view('livewire.account.verification')->layout('layouts.account');
    }

    public function verify(){
        $verifyType = VerificationType::find($this->verifyType);

        if($verifyType->slug == Str::slug('NIN')) {
            $this->validate([
                'id_no' => 'required',
                'frontId' => 'required|image',
                'backId' => 'required|image'
            ]);

            $response = $this->verifyNIN($this->id_no);
            if ($response && count($response->response)) {
                $this->verificationData = $this->saveNINVerificationRecord($response->response[0]);
                session()->flash('message', 'Your information has been received and will be processed within 2 working days. Thank you.');
            }else{
                $this->addError('nin', 'Invalid NIN');
            }
        }elseif ($verifyType->slug==Str::slug('PASSPORT')){
            $this->validate([
                'id_no' => 'required',
                'frontId' => 'required|image'
            ]);

            $response = $this->verifyPassport([
                'passport_no' => $this->id_no,
                'first_name' => auth()->user()->first_name,
                'last_name' => auth()->user()->last_name,
                'dob' => Carbon::parse(auth()->user()->dob)->format('Y-m-d')
            ]);

            if ($response && isset($response->response)) {
                $this->verificationData = $this->savePassportVerificationRecord($response->response);

                session()->flash('message', 'Your information has been received and will be processed within 2 working days. Thank you.');
            }else{
                $this->addError('passport_no', 'Invalid Passport Number');
            }

        }elseif($verifyType->slug== Str::slug('DRIVERSLICENSE')){
            $this->validate([
                'id_no' => 'required',
                'frontId' => 'required|image',
                'backId' => 'required|image'
            ]);

            $media = auth()->user()->getMedia('avatar');

            if(!blank($media)){
                $mime = $media[0]->mime_type;
                $selfieUrl = $media[0]->getPath('thumb');
                $base64string = 'data:image/jpg;base64,'.base64_encode($selfieUrl);
            }else {
                $selfieUrl = Str::remove('/storage', auth()->user()->avatar_url);
                $mime = Storage::disk('public')->mimeType($selfieUrl);
                $base64string = 'data:image/jpg;base64,'.base64_encode(Storage::disk('public')->get($selfieUrl));
            }

            $response = $this->verifyByDriversLicense([
                'frsc' => $this->id_no,
                'firstname' => $this->first_name,
                'surname' => $this->last_name,
                'dob' => Carbon::parse(auth()->user()->dob)->format('Y-m-d'),
                'selfie' => $base64string
            ]);

//            FFF4028711111
            if ($response && $response->status=='VERIFIED') {
                $this->saveDVLicenseRecord($response);
            }

            session()->flash('message', 'Your information has been received and will be processed within 2 working days. Thank you.');

        }elseif ($verifyType->slug == Str::slug('VOTERSCARD')){
            $this->validate([
                'id_no' => 'required',
                'frontId' => 'required|image',
                'backId' => 'required|image'
            ]);

            $media = auth()->user()->getMedia('avatar');

            if(!blank($media)){
                $mime = $media[0]->mime_type;
                $selfieUrl = $media[0]->getPath('thumb');
                $base64string = 'data:image/jpg;base64,'.base64_encode($selfieUrl);
            }else {
                $selfieUrl = Str::remove('/storage', auth()->user()->avatar_url);
                $mime = Storage::disk('public')->mimeType($selfieUrl);
                $base64string = 'data:image/jpg;base64,'.base64_encode(Storage::disk('public')->get($selfieUrl));
            }

            $response = $this->verifyVotersCard([
                'vin' => $this->id_no,
                'country' => auth()->user()->country->name,
                'selfie' => $base64string,
                'match_selfie_to_db' => true
            ]);

            if ($response && isset($response->response)) {
                $this->verificationData = $this->saveVotersCardVerificationRecord($response->response);
                session()->flash('message', 'Your information has been received and will be processed within 2 working days. Thank you.');
            }else{
                $this->addError('vin', 'Invalid Voters Card Information');
            }
        }
    }

    public function verifyAddress(){
        $this->validate([
            'utilityBill'=>'required|image'
        ]);

        $verifyType = VerificationType::find($this->verifyType);

        if($this->verification_record){
            $this->addError('address', 'ID verification is required before verifying address');
        }
        if($verifyType->slug != Str::slug(VerificationTypes::ADDRESS())){
            $this->addError('address', 'An unknown error occurred');
        }

        $record = new UserVerification();
        $record->user_id = auth()->user()->id;
        $record->verification_type_id = $verifyType->id;
        $record->id_no = auth()->user()->account_id;
        $record->first_name = auth()->user()->first_name;
        $record->last_name = auth()->user()->last_name;
        $record->save();

        $record->addMedia($this->utilityBill->getRealPath())->toMediaCollection('doc');
        session()->flash('message', 'Your information has been received and will be processed within 2 working days. Thank you.');
    }

    private function saveNINVerificationRecord($data){
        $verifyType = VerificationType::find($this->verifyType);

        $record = new UserVerification();
        $record->user_id = auth()->user()->id;
        $record->verification_type_id = $verifyType->id;
        $record->id_no = $data->nin ?? $this->id_no;
        $record->first_name = $data->firstname;
        $record->last_name = $data->surname;
        $record->middle_name = $data->middlename;
        $record->email = $data->email;
        $record->phone = $data->telephoneno;
        $record->dob = Carbon::parse($data->birthdate);
        $record->title = $data->title;
        $record->gender = $data->gender;
        $record->marital_status = $data->maritalstatus;
        $record->birth_country = $data->birthcountry;
        $record->birth_state = $data->birthstate;
        $record->religion = $data->religion;
        $record->save();

        $record->addMedia($this->frontId->getRealPath())->toMediaCollection('doc');

        if($this->backId){
            $record->addMedia($this->backId->getRealPath())->toMediaCollection('doc_back');
        }

        $imageName = Str::random(10).'.'.'png';
        Storage::disk('public')->put($imageName, base64_decode($data->photo));
        $record->addMediaFromUrl(Storage::disk('public')->url($imageName))->toMediaCollection('user_photo');
        Storage::disk('public')->delete($imageName);

        return $record;
    }

    private function saveDVLicenseRecord($data){
        $verifyType = VerificationType::find($this->verifyType);

        $record = new UserVerification();
        $record->user_id = auth()->user()->id;
        $record->verification_type_id = $verifyType->id;
        $record->id_no = $this->id_no;
        $record->first_name = auth()->user()->first_name;
        $record->last_name = auth()->user()->last_name;
        $record->email = auth()->user()->email;
        $record->phone = auth()->user()->phone;
        $record->save();

        $record->addMedia($this->frontId->getRealPath())->toMediaCollection('doc');
        if($this->backId){
            $record->addMedia($this->backId->getRealPath())->toMediaCollection('doc_back');
        }
        return $record;
    }

    private function savePassportVerificationRecord($data){
        $verifyType = VerificationType::find($this->verifyType);

        $record = new UserVerification();
        $record->user_id = auth()->user()->id;
        $record->verification_type_id = $verifyType->id;
        $record->id_no = $data->reference_id ?? $this->id_no;
        $record->first_name = $data->first_name;
        $record->last_name = $data->last_name;
        $record->middle_name = $data->middle_name;
        $record->phone = $data->mobile;
        $record->dob = Carbon::parse($data->dob);
        $record->gender = $data->gender;
        $record->expiry_date = $data->expiry_date;
        $record->issued_at = $data->issued_at;
        $record->issued_date = $data->issued_date;
        $record->save();

        $record->addMedia($this->frontId->getRealPath())->toMediaCollection('doc');
        if($this->backId){
            $record->addMedia($this->backId->getRealPath())->toMediaCollection('doc_back');
        }

        $imageName = Str::random(10).'.'.'png';
        Storage::disk('public')->put($imageName, base64_decode($data->photo));
        $record->addMediaFromUrl(Storage::disk('public')->url($imageName))->toMediaCollection('user_photo');
        Storage::disk('public')->delete($imageName);

        return $record;
    }

    private function saveVotersCardVerificationRecord($data){
        $verifyType = VerificationType::find($this->verifyType);

        $record = new UserVerification();
        $record->user_id = auth()->user()->id;
        $record->verification_type_id = $verifyType->id;
        $record->id_no = $data->reference_id ?? $this->id_no;
        $record->first_name = $data->first_name;
        $record->last_name = $data->last_name;
        $record->middle_name = $data->middle_name;
        $record->phone = $data->mobile;
        $record->dob = Carbon::parse($data->dob);
        $record->gender = $data->gender;
        $record->expiry_date = $data->expiry_date;
        $record->issued_at = $data->issued_at;
        $record->issued_date = $data->issued_date;
        $record->save();

        $record->addMedia($this->frontId->getRealPath())->toMediaCollection('doc');
        if($this->backId){
            $record->addMedia($this->backId->getRealPath())->toMediaCollection('doc_back');
        }
        $imageName = Str::random(10).'.'.'png';
        Storage::disk('public')->put($imageName, base64_decode($data->photo));
        $record->addMediaFromUrl(Storage::disk('public')->url($imageName))->toMediaCollection('user_photo');
        Storage::disk('public')->delete($imageName);

        return $record;
    }

}
