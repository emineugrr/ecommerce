<?php

namespace App\Http\Controllers\Frontend;
use \App\Models\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function products(){
     return view('frontend.pages.products');

    }
    public function discounted(){
        return view('frontend.pages.products');
    }

   public function productsdetail(){
     return view('frontend.pages.productsdetail');

   }

   public function about()
{
     $about = About::first();
    return view('frontend.pages.about', compact('about'));
}

   public function contact(){
    return view('frontend.pages.contact');

   }
   public function cart(){
     return view('frontend.pages.cart');

   }


}
