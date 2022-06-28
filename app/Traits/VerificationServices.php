<?php
namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait VerificationServices{
    protected $base_url = 'https://api.verified.africa';

    public function verifyNIN($nin){
        $response = Http::withHeaders([
            'apiKey' => setting('verifyafrica_nin_key', env('VERIFYAFRICA_NIN_KEY')),
            'userid' => setting('verifyafrica_userid', env('VERIFYAFRICA_USERID'))
        ])->post($this->base_url.'/sfx-verify/v3/id-service', [
            'searchParameter' => $nin,
            "verificationType"=> "NIN-SEARCH"
        ]);

        if($response->successful()) {
            return $response->object();
        }

        return false;
    }

    public function verifyByNIN($nin){
        $response = Http::withHeaders([
            'apiKey' => setting('verifyafrica_nin_key', env('VERIFYAFRICA_NIN_KEY')),
            'userid' => setting('verifyafrica_userid', env('VERIFYAFRICA_USERID'))
        ])->post('https://app.verified.ng/sfx-verify/v2/vin', [
            'searchParameter' => $nin,
            "verificationType"=> "NIN-SEARCH"
        ]);

        if($response->successful()) {
            return $response->object();
        }

        return false;
    }

    public function verifyVotersCard($data){
        $response = Http::withHeaders([
            'apiKey' => setting('verifyafrica_voters_key', env('VERIFYAFRICA_VOTERS_CARD_KEY')),
            'userid' => setting('verifyafrica_userid', env('VERIFYAFRICA_USERID'))
        ])->post($this->base_url.'/sfx-verify/v3/id-service', [
            'searchParameter' => 'A07011111', //(string)$data['vin'],
            'country' => 'Nigeria', //(string)$data['country'], //'Doe',
            'selfie' => (string)$data['selfie'], //'John',
            'verificationType'=> 'VIN-FACE-MATCH-VERIFICATION',
            'selfieToDatabaseMatch' => $data['match_selfie_to_db'] ?? true
        ]);

        if($response->successful()) {
            return $response->object();
        }
        return $response->object();
    }

    public function verifyByDriversLicense($data){
        $response = Http::withHeaders([
            'api-key' => env('VERIFYAFRICA_DV_LICENSE_BOOLEAN_KEY'),
            'userid' => setting('verifyafrica_userid', env('VERIFYAFRICA_USERID'))
        ])->post('https://app.verified.ng/sfx-verify/v2/frsc', [
            'frsc' =>  (string)$data['frsc'],
            'firstname' => (string)$data['firstname'], //'Doe',
            'surname' => (string)$data['surname'], //'John',
            'dob' => (string)$data['dob'],
            'callbackURL' => url('/callback')
        ]);

        if($response->successful()) {
            return $response->object();
        }

        return false;
    }

    public function verifyPassport($data){
        $response = Http::withHeaders([
            'apiKey' => setting('verifyafrica_passport_key', env('VERIFYAFRICA_INTL_PASSPORT_KEY')),
            'userid' => setting('verifyafrica_userid', env('VERIFYAFRICA_USERID'))
        ])->post($this->base_url.'/sfx-verify/v3/id-service', [
            'searchParameter' =>  (string)$data['passport_no'], //'A07011111',
            'lastName' => (string)$data['last_name'], //'Doe',
            'firstName' => (string)$data['first_name'], //'John',
            'dob' => (string)$data['dob'], //'1974-09-24',
            "verificationType"=> "PASSPORT-FULL-DETAILS"
        ]);

        if($response->successful()) {
            return $response->object();
        }

        return false;
    }
}
