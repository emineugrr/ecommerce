<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PageHomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\AjaxController;






Route::get('/',[PageHomeController::class,'homepage'])->name('homepage');





Route::get('/products',[PageController::class,'products'])->name('products');
Route::get('/men-collection',[PageController::class,'products'])->name('menproducts');
Route::get('/women-collection',[PageController::class,'products'])->name('womenproducts');
Route::get('/childiren-collection',[PageController::class,'products'])->name('childirenproducts');
Route::get('/discounted',[PageController::class,'discountedproducts'])->name('discountedproducts');


Route::get('/products/{slug}',[PageController::class,'productsdetail'])->name('productsdetail');

Route::get('/about',[PageController::class,'about'])->name('about');

Route::get('/contact',[PageController::class,'contact'])->name('contact');

Route::post('/contact/save',[AjaxController::class,'contactsave'])->name('contact.save');


Route::get('/cart',[PageController::class,'cart'])->name('cart');

