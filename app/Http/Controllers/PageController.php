<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function contact(){
        return view('pages.contact');
    }

    public function about(){
        return view('pages.about');
    }

    public function terms(){
        return view('pages.terms');
    }

    public function privacyPolicy(){
        return view('pages.privacy-policy');
    }

    public function refundPolicy(){
        return view('pages.refund-policy');
    }

    public function cookiePolicy(){
        return view('pages.cookie-policy');
    }

    public function products(){
        $products = Product::default()->paginate();
        return view('pages.products', compact('products'));
    }

}
