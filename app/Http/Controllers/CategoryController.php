<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;


class CategoryController extends Controller
{
// Show all category

     public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }


// Show products inside one category
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->paginate(12);

        return view('shop', compact('products', 'category'));
    }
}