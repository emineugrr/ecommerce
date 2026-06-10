<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
            'title' => $request->title,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'detail' => $request->detail,
            'image' => $imagePath,
            'price' => $request->price,
            'stock' => $request->stock ?? 0,
            'minstock' => $request->minstock ?? 0,
            'discount' => $request->discount ?? 0,
            'status' => $request->status ?? 0,
            'slug' => \Illuminate\Support\Str::slug($request->title),
        ]);

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'detail' => $request->detail,
            'price' => $request->price,
            'stock' => $request->stock ?? 0,
            'minstock' => $request->minstock ?? 0,
            'discount' => $request->discount ?? 0,
            'status' => $request->status ?? 0,
            'slug' => \Illuminate\Support\Str::slug($request->title),
        ]);

        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully.');
    }
}
