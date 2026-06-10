<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PageHomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;


Route::get('/', [PageHomeController::class, 'homepage'])->name('home');
Route::get('/home', function () { return redirect()->route('home'); })->name('homepage'); // Direct alias fallback

Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/men-collection', [PageController::class, 'products'])->name('menproducts');
Route::get('/women-collection', [PageController::class, 'products'])->name('womenproducts');
Route::get('/childiren-collection', [PageController::class, 'products'])->name('childirenproducts');
Route::get('/discounted', [PageController::class, 'discountedproducts'])->name('discountedproducts');
Route::get('/products/{slug}', [PageController::class, 'productsdetail'])->name('productsdetail');

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact/save', [AjaxController::class, 'contactsave'])->name('contact.save');



Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});



Route::middleware('auth')->group(function () {


    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/cart/list', [CartController::class, 'index'])->name('cart.index');

    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{cartId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartId}', [CartController::class, 'remove'])->name('cart.remove');


    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('checkout.place');
});



Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {


    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('dashboard');


    Route::resource('product', AdminProductController::class);

    
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/show/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/status/{id}', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});
