<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\About;
use App\Models\Category;

class PageController extends Controller
{
    public function products(Request $request)
    {


        $size =$request->size ?? null;
        $color=$request->color ?? null;
        $startprice=$request->start_price  ?? null;
        $endprice=$request->end_price ?? null;

  $products = Product::where('status', '1')
     ->where(function($q) use($size,$color,$startprice,$endprice){
        if(!empty($size)){
          $q->where('size',$size);
        }
        if(!empty($color)){
          $q->where('color',$color);
        }
         if(!empty($startprice)&& ($endprice)){
          $q->whereBetween('price',[$startprice,$endprice]);
        }
        return $q;

     })
      ->paginate(1);

     

        return view('frontend.pages.products', compact('products'));
    }

    public function discounted()
    {
        $products = Product::where('status', '1')->get();

        return view('frontend.pages.products', compact('products','categories'));
    }

    public function productsdetail($slug)
{
    $product = Product::where('slug',$slug)->first();

    return view('frontend.pages.productsdetail',compact('product'));
}

    public function about()
    {
        $about = About::first();

        return view('frontend.pages.about', compact('about'));
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function cart()
    {
        return view('frontend.pages.cart');
    }
}
