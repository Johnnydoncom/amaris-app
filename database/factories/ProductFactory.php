<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Country;
use App\Models\Platform;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'subheading' => $this->faker->sentence(10),
            'description' => $this->faker->paragraph(10),
            'user_id' => function(){
                return User::find(1)->id;
            },
            'product_type' => 'gift_card',
            'redemption_type' => 'In Store Redemption',
            'country_id' => function(){
                return Country::all()->random()->id;
            },
            'platform_id' => function(){
                return Platform::all()->random()->id;
            },
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $url = 'https://source.unsplash.com/random/1200x800';
            $product
                ->addMediaFromUrl($url)
                ->toMediaCollection('featured_image');
        });
    }
}
