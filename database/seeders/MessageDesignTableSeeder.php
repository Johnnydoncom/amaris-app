<?php

namespace Database\Seeders;

use App\Models\MessageCategory;
use App\Models\MessageDesigns;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MessageDesignTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        // Categories
        $categories = config('giftcard.message_categories');
        foreach ($categories as $category){
            $cat = MessageCategory::create(['name' => $category]);
            $path = '/carriers/'.Str::slug($category, '_');

            if(Storage::disk('public')->exists($path)) {
                foreach (Storage::disk('public')->files($path) as $file) {
                    $design = MessageDesigns::create([
                       'title' => $faker->sentence(4),
                        'message_category_id' => $cat->id
                    ]);
                    $design
                        ->addMediaFromUrl(Storage::disk('public')->url($file))
                        ->toMediaCollection('featured_image');
                }
            }
        }


    }
}
