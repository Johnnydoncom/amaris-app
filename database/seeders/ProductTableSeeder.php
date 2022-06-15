<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_products = array(
            [
                'name' => '70ah Lithium Power System (500w inverter/150w Solar Panel)',
                'description' => "
<p>70ah Lithium Battery, 500w Inverter and 150watts solar (mono)</p>
<p>Last 6 hours on led Tv</p>
<p>8 hours on small standing fan (rubber blade not more than 30w)</p>
<p>12 hours on 90w laptop when used individually</p>",
                'regular_price' => 130000,
                'image' => Storage::disk('public')->url('uploads/default-products/power-product-1A.jpg'),
                'gallery' => [
                    Storage::disk('public')->url('uploads/default-products/power-product-1B.jpg'),
                    Storage::disk('public')->url('uploads/default-products/power-product-1C.jpg'),
                    Storage::disk('public')->url('uploads/default-products/power-product-1D.jpg'),
                    Storage::disk('public')->url('uploads/default-products/power-product-1E.jpg')
                ]
            ],
            [
                'name' => '150ah Lithium Power System (1000w Inverter+2pcs 150w Solar panel mono)',
                'description' => "
<ul class='list-disc ml-4'>
<li>Charge duration: 8hrs</li>
<li>working duration: 12hrs</li>
<li>work with inverter 1000watts</li>
<li>charge with solar/generator/nepa-light</li>
<li>Electronics: Led Tv, Home theatre, Laptop, standing fan, bulbs, clipper, blender, decoder, phones</li>
</ul>
<p>12 hours on 90w laptop when used individually</p>",
                'regular_price' => 220000,
                'image' => Storage::disk('public')->url('uploads/default-products/power-product-2A.jpg'),
                'gallery' => [
                    Storage::disk('public')->url('uploads/default-products/power-product-2B.jpg'),
                    Storage::disk('public')->url('uploads/default-products/power-product-2C.jpg')
                ]
            ],
            [
                'name' => '250ah Lithium Power System (+2000w Inverter)',
                'description' => "
<ul class='list-disc ml-4'>
<li>Charge duration: 8hrs</li>
<li>working duration: 12hrs</li>
<li>Work with inverter 1000watts</li>
<li>charge with solar/generator/nepa-light</li>
<li>Electronics: Led Tv, Home theatre, Laptop, standing fan, bulbs, clipper, blender, decoder, phones</li>
</ul>",
                'regular_price' => 250000,
                'image' => Storage::disk('public')->url('uploads/default-products/power-product-3.jpg'),
                'gallery' => null
            ],
            [
                'name' => '1.7kva Power System (2 Batteries, 220ah Tubular batteries wet cells and 10 Solar Panels of 200w each)',
                'description' => "<p>1.7kva Inverter with 2 Batteries (220ah Tubular batteries wet cells) and 10 Solar Panels of 200w each</p>
<p>Can power led tv, led bulbs, refrigerator, led fans and phones.</p>
<p>Takes 8 hours to fully charge with Solar (Sun), Nepa or Generator.</p>
<p>Solar Panels are Foreign (Fairly used) and comes with over 10 Years lifespan, Batteries and Inverter comes with 12 months warranty.</p>",
                'regular_price' => 1000000,
                'image' => Storage::disk('public')->url('uploads/default-products/power-product-4A.jpg'),
                'gallery' => [
                    Storage::disk('public')->url('uploads/default-products/power-product-4B.jpg')
                ]
            ],
            [
                'name' => '2.5kva Power System (2 batteries, 220ah Tubular batteries and 8 Solar Panels of 200w each)',
                'description' => "<p>2.5kva Inverter, 2 batteries (220ah Tubular batteries) and 8 Solar Panels of 200w each</p>
<p>Can power led TV, led bulbs, refrigerator, led fans and phones.</p>
<p>Takes 8 hours to fully charge with Solar (Sun), Nepa or Generator.</p>
<p>Solar Panels are Foreign (Fairly used) Tokunbo and comes with over 10 Years lifespan, Batteries and Inverter comes with 12 months warranty.</p>",
                'regular_price' => 1400000,
                'image' => Storage::disk('public')->url('uploads/default-products/power-product-5A.jpg'),
                'gallery' => [
                    Storage::disk('public')->url('uploads/default-products/power-product-5B.jpg')
                ]
            ],
        );

        foreach ((object)$default_products as $key => $pr){
            $product = new Product();
            $product->title = $pr['name'];
            $product->description = nl2br($pr['description']);
            $product->regular_price = $pr['regular_price'];
            $product->category_id = 1;
            $product->product_type = 'default';
            $product->user_id = 1;
            $product->save();

//            $url = 'https://source.unsplash.com/random/1200x800';
            $product
                ->addMediaFromUrl($pr['image'])
                ->toMediaCollection('featured_image');

            if($pr['gallery']){
                foreach ($pr['gallery'] as $url){
                    $product
                        ->addMediaFromUrl($url)
                        ->toMediaCollection('gallery');
                }
            }
        }
    }
}
