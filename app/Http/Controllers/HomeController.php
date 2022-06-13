<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index(Request $request){

        $clientIP = $request->getClientIp();
        $location = geoip($clientIP)->toArray();

        $products = Product::whereStatus(true)->default()->paginate();

        $platforms = Platform::whereHas('products.country', function ($query)use($location){
//            $query->where('iso2', $location['iso_code']);
        })->get();

        $slides = [
            Storage::url('uploads/home-banners/slide1.jpg'),
            Storage::url('uploads/home-banners/slide2.jpg')
        ];


        return view('welcome', [
            'products' => $products,
            'platforms' => $platforms,
            'location' => $location,
            'slides' => $slides
        ]);
    }
}
