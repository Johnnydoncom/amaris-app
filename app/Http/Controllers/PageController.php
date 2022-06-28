<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Storage;

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

    public function disclaimer(){
        return view('pages.disclaimer');
    }

    public function policyCompliance(){
        return view('pages.company-policies');
    }

    public function products(){
        $products = Product::default()->paginate();
        return view('pages.products', compact('products'));
    }

    public function ninjaPower(){
        $products = Product::whereHas('category',function ($q){
            $q->whereSlug('ninja-power-system');
        })->paginate();

        return view('pages.power-system', compact('products'));
    }

    public function webDesign(){
        SEOTools::setTitle('Web Design & Development');
        SEOTools::setDescription('Amaris Synergy specialise in Web Design and SEO. Our team of website designers build fresh, professional websites that help you achieve your business goals. Contact us today +2349063204011.');
//        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@Amaris');
        SEOTools::jsonLd()->addImage(Storage::url('web-design-company-nigeria.png'));

        return view('pages.web-design');
    }

    public function graphicDesign(){
        SEOTools::setTitle('Graphic Design');
        SEOTools::setDescription('Amaris Synergy specialise in Web Design and SEO. Our team of website designers build fresh, professional websites that help you achieve your business goals. Contact us today +2349063204011.');
//        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@Amaris');
        SEOTools::jsonLd()->addImage(Storage::url('web-design-company-nigeria.png'));

        return view('pages.graphic-design');
    }

    public function contentCreation(){
        SEOTools::setTitle('Web Content Creation');
        SEOTools::setDescription('Amaris Synergy specialise in web content creation and SEO. Our team of graphic designers build eye-catching, professional graphics that help you achieve your business goals. Contact us today +2349063204011.');
//        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@Amaris');
        SEOTools::jsonLd()->addImage(Storage::url('web-design-company-nigeria.png'));

        return view('pages.content-creation');
    }

    public function smm(){
        SEOTools::setTitle('Social Media Marketing');
        SEOTools::setDescription('Amaris Synergy specialise in web content creation and SEO. Our team of graphic designers build eye-catching, professional graphics that help you achieve your business goals. Contact us today +2349063204011.');
//        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@Amaris');
        SEOTools::jsonLd()->addImage(Storage::url('web-design-company-nigeria.png'));

        return view('pages.social-media-marketing');
    }

}
