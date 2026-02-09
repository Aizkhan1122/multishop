<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
     public function index(Request $request)
    {
        // Get ?category=dresses, etc.
        $category = $request->query('category');

        if ($category) {
            $products = Product::whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            })->get();
        } else {
            $products = Product::all();
        }

        // Render your existing shop.blade.php
        return view('shop.index', compact('products'));
    }
}
