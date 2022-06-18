<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UpdateCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencies:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update site currencies';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currencies = DB::table('currencies')->get()->pluck('code');
        $apiUrl = 'https://api.apilayer.com/exchangerates_data/latest';
        $response = Http::withHeaders([
            'apikey' => env('APILAYER_EXCHANGE_API')
        ])->get($apiUrl, [
            'symbols' => implode(',', $currencies->toArray()),
            'base' => env('DEFAULT_CURRENCY'),
        ]);

        if($response->successful()){
            $object = $response->object();

            foreach ($object->rates as $code => $rate){
                DB::table('currencies')->where('code', $code)->update(['exchange_rate'=>$rate]);
            }
        }
    }
}
