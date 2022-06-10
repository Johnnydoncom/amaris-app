<?php

namespace Database\Seeders;

use App\Models\MessageCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomMessageCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = config('giftcard.message_categories');
        foreach ($categories as $category){
            MessageCategory::create([
                'name' => $category
            ]);
        }
    }
}
