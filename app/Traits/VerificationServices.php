<?php
namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait VerificationServices{
    protected $base_url = 'https://api.verified.africa';

    public function verifyNIN($nin){
        $response = Http::withHeaders([
            'apiKey' => env('VERIFYAFRICA_NIN_KEY'),
            'userid' => env('VERIFYAFRICA_USERID')
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
            'apiKey' => env('VERIFYAFRICA_NIN_KEY'),
            'userid' => env('VERIFYAFRICA_USERID')
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
            'apiKey' => env('VERIFYAFRICA_VOTERS_CARD_KEY'),
            'userid' => env('VERIFYAFRICA_USERID')
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

    public function verifyByDriversLicense($frsc, $fname,$surname,$phone,$dob){

        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://app.verified.ng/sfx-verify/v2/frsc', [
            'body' => '{"firstname":"John","surname":"Doe","phone":"07030000000","frsc":"FFF4028711111","dob":"1993-11-06"}',
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'api-key' => env('VERIFYAFRICA_DRIVERS_LICENSE_KEY'),
                'userid' => env('VERIFYAFRICA_USERID'),
            ],
        ]);
        return $response->getBody();


        if(1>3) {
            $response = Http::withHeaders([
                'api-key' => env('VERIFYAFRICA_DRIVERS_LICENSE_KEY'),
                'userid' => env('VERIFYAFRICA_USERID')
            ])->post('https://app.verified.ng/sfx-verify/v2/frsc', [
                'frsc' => $frsc,
                "firstname" => 'John', //$fname,
                'surname' => 'Doe', //$surname,
                'phone' => '07030000000', //$phone,
                'dob' => '1993-11-06', //$dob
                'callbackURL' => ''
            ]);

            if ($response->successful()) {
                return $response->object();
            }
            return $response;
        }
    }

    public function verifyPassport($data){
        $response = Http::withHeaders([
            'apiKey' => env('VERIFYAFRICA_INTL_PASSPORT_KEY'),
            'userid' => env('VERIFYAFRICA_USERID')
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
