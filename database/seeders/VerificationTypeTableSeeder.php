<?php

namespace Database\Seeders;

use App\Models\VerificationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VerificationTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = config('giftcard.verification_types');
        foreach ($types as $key => $type){
            VerificationType::create([
                'name' => $type,
                'slug' => $key
            ]);
        }
    }
}
