<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class OrderController extends Controller
{
    public function checkout() {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $subtotal = $cartItems->sum(function($item) { return $item->price * $item->quantity; });
        $shippingPrice = 0;
        $total = $subtotal + $shippingPrice;

        // Points to resources/views/frontend/checkout.blade.php
        return view('frontend.checkout', compact('cartItems', 'subtotal', 'shippingPrice', 'total'));
    }

    public function placeOrder(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'shipping_method' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
        ]);

        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        DB::transaction(function () use ($request, $cartItems) {
            $subtotal = $cartItems->sum(function($item) { return $item->price * $item->quantity; });
            $shippingPrice = $request->shipping_method === 'Standard Shipping' ? 4 : 0;
            $total = $subtotal + $shippingPrice;

            $order = Order::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
                'zip_code' => $request->zip_code,
                'subtotal' => $subtotal,
                'shipping_price' => $shippingPrice,
                'total' => $total,
                'shipping_method' => $request->shipping_method,
                'payment_method' => $request->payment_method,
                'status' => 'New',
            ]);

            foreach ($cartItems as $item) {
                $product = $item->product;
                if ($product->stock < $item->quantity) {
                    throw new Exception($product->title . " does not have enough stock.");
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_title' => $product->title,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'total' => $item->price * $item->quantity
                ]);
                $product->decrement('stock', $item->quantity);
            }
            Cart::where('user_id', Auth::id())->delete();
        });

        return redirect()->route('home')->with('success', 'Your order has been placed successfully.');
    }
}
