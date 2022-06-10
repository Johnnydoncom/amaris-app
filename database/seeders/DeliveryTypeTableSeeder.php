<?php

namespace Database\Seeders;

use App\Models\DeliveryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = config('giftcard.delivery_types');
        foreach ($types as $key => $type){
            DeliveryType::create([
                'name' => $type['title'],
                'slug' => $key,
                'description' => $type['description']
            ]);
        }
    }
}
