<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        // Points to resources/views/frontend/cart.blade.php
        return view('frontend.cart', compact('cartItems'));
    }

    public function add(Request $request, $productId) {
        $product = Product::findOrFail($productId);
        $quantity = $request->quantity ?? 1;

        if ($product->stock < $quantity) {
            return back()->with('error', 'Not enough stock available.');
        }

        $cart = Cart::where('user_id', Auth::id())->where('product_id', $product->id)->first();
        if ($cart) {
            $newQty = $cart->quantity + $quantity;
            if ($product->stock < $newQty) {
                return back()->with('error', 'Not enough stock available.');
            }
            $cart->update(['quantity' => $newQty, 'price' => $product->price]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price
            ]);
        }
        return redirect()->route('cart')->with('success', 'Product added to cart.');
    }

    public function update(Request $request, $cartId) {
        $cart = Cart::where('user_id', Auth::id())->findOrFail($cartId);
        if ($cart->product->stock < $request->quantity) {
            return back()->with('error', 'Not enough stock available.');
        }
        $cart->update(['quantity' => $request->quantity]);
        return back()->with('success', 'Cart updated.');
    }

    public function remove($cartId) {
        Cart::where('user_id', Auth::id())->findOrFail($cartId)->delete();
        return back()->with('success', 'Product removed from cart.');
    }
}
