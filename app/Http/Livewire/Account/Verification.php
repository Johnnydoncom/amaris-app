<?php

namespace App\Http\Livewire\Account;

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

    public $verification_record;

    public $verificationTypes;
    public $verifyType=1;
    public $verifyDoc;
    public $verified = false;
    public $id_no,$passport_no,$dv_license_no,$vin;
    public $verificationData = [];

    protected $rules = [
        'id_no' => 'required',
        'verifyDoc' => 'required|image'
    ];

    public function mount(){
        $this->user = User::find(auth()->user()->id);
        $this->verificationTypes = VerificationType::all();
        $this->countries = Country::get(['id','name']);

        $this->last_name = auth()->user()->last_name;
        $this->first_name = auth()->user()->first_name;
        $this->dob = auth()->user()->dob;
    }

    public function updatedVerifyType(){
        $this->reset(['id_no']);
    }

    public function render()
    {
        $this->verification_record = auth()->user()->verifications()->latest()->first();
        if($this->verification_record){
            $this->verifyType =  $this->verification_record->verification_type_id;
            $this->id_no =  $this->verification_record->id_no;
        }

        return view('livewire.account.verification')->layout('layouts.account');
    }

    public function verify(){
        $this->validate();

        $verifyType = VerificationType::find($this->verifyType);

        if($verifyType->slug=='nin') {
            $response = $this->verifyNIN($this->id_no);
            if ($response && count($response->response)) {

                $this->verificationData = $this->saveNINVerificationRecord($response->response[0]);

                session()->flash('message', 'Your information has been received and will be processed within 2 working days. Thank you.');

//                if (Str::lower($response->response[0]->surname) == Str::lower(auth()->user()->last_name) && Str::lower($response->response[0]->firstname) == Str::lower(auth()->user()->first_name)) {
//                    $this->verified = true;
//                }
            }else{

                $this->addError('nin', 'Invalid NIN');
            }
        }elseif ($verifyType->slug=='passport'){
            $response = $this->verifyPassport([
                'passport_no' => $this->id_no,
                'first_name' => auth()->user()->first_name,
                'last_name' => auth()->user()->last_name,
                'dob' => auth()->user()->dob
            ]);

            if ($response && isset($response->response)) {
                $this->verificationData = $this->savePassportVerificationRecord($response->response);

                session()->flash('message', 'Your information has been received and will be processed within 2 working days. Thank you.');
            }else{
                $this->addError('passport_no', 'Invalid Passport Number');
            }

        }elseif($verifyType->slug=='drivers_license'){
            $response = $this->verifyByDriversLicense($this->id_no, $this->first_name, $this->last_name, $this->phone, $this->dob);

            echo json_encode($response);
            exit();

            if ($response && $response->status=='VERIFIED') {
                $this->verified = true;
            }

            session()->flash('message', 'Your information has been received and will be processed within 2 working days. Thank you.');


        }elseif ($verifyType->slug=='voters_card'){
            if($media = auth()->user()->getMedia('avatar')){
                $mime = $media[0]->mime_type;
                $selfieUrl = $media[0]->getPath('thumb');
                $base64string = 'data:image/jpg;base64,'.base64_encode($selfieUrl);
            }else {
                $selfieUrl = Str::remove('/storage', auth()->user()->avatar_url);
                $mime = Storage::disk('public')->mimeType($selfieUrl);
                $base64string = 'data:image/jpg;base64,'.base64_encode(Storage::disk('public')->get($selfieUrl));
            }


//            echo $base64string;
//            exit();

//            $this->addError('vin', 'Invalid Voters Card Information');

            $response = $this->verifyVotersCard([
                'vin' => $this->id_no,
                'country' => auth()->user()->country->name,
                'selfie' => $base64string,
                'match_selfie_to_db' => true
            ]);

//            $this->addError('vin', 'Invalid Voters Card Information');
//            echo json_encode($response);
//            exit();

            if ($response && isset($response->response)) {
                $this->verificationData = $this->saveVotersCardVerificationRecord($response->response);

                session()->flash('message', 'Your information has been received and will be processed within 2 working days. Thank you.');
            }else{
                $this->addError('vin', 'Invalid Voters Card Information');
            }
        }

        session()->flash('verified');
    }


    private function saveNINVerificationRecord($data){
        $verifyType = VerificationType::find($this->verifyType);

        $record = new UserVerification();
        $record->user_id = auth()->user()->id;
        $record->verification_type_id = $verifyType->id;
        $record->id_no = $data->nin;
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

        $record->addMedia($this->verifyDoc->getRealPath())->toMediaCollection('doc');

        $imageName = Str::random(10).'.'.'png';
        Storage::disk('public')->put($imageName, base64_decode($data->photo));
        $record->addMediaFromUrl(Storage::disk('public')->url($imageName))->toMediaCollection('user_photo');
        Storage::disk('public')->delete($imageName);

        return $record;
    }

    private function savePassportVerificationRecord($data){
        $verifyType = VerificationType::find($this->verifyType);

        $record = new UserVerification();
        $record->user_id = auth()->user()->id;
        $record->verification_type_id = $verifyType->id;
        $record->id_no = $data->reference_id;
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

        $record->addMedia($this->verifyDoc->getRealPath())->toMediaCollection('doc');

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
        $record->id_no = $data->reference_id;
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

        $record->addMedia($this->verifyDoc->getRealPath())->toMediaCollection('doc');

        $imageName = Str::random(10).'.'.'png';
        Storage::disk('public')->put($imageName, base64_decode($data->photo));
        $record->addMediaFromUrl(Storage::disk('public')->url($imageName))->toMediaCollection('user_photo');
        Storage::disk('public')->delete($imageName);

        return $record;
    }

}
