<?php

namespace Database\Seeders;

use App\Enums\VerificationTypes;
use App\Models\VerificationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VerificationTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = VerificationTypes::options();
        foreach ($types as $key => $type){
            VerificationType::create([
                'name' => $type,
                'slug' => Str::lower($key)
            ]);
        }
    }
}
