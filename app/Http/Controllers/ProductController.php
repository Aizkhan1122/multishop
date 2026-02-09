<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
     public function shop()
    {
        $products = Product::all();
        return view('shop', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('products'));
    }

    public function create()
   {
    // $categories = Category::all();
    $categories = Category::where('shop_id', auth()->user()->shop_id)->get();
    return view('products.create', compact('categories'));
   }

   public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

}
