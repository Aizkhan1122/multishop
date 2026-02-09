<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // Show all products
    public function index()
    {
        $products = Product::where('shop_id', auth('admin')->user()->shop_id)->get();
        return view('admin.products.index', compact('products'));
    }

    // Show form to create product
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Store product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable|image',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'shop_id'     => auth('admin')->user()->shop_id,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created!');
    }

    // Edit product
    public function edit(Product $product)
    {
        if ($product->shop_id !== auth('admin')->user()->shop_id) {
            abort(403, 'Unauthorized');
        }
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        if ($product->shop_id !== auth('admin')->user()->shop_id) {
            abort(403, 'Unauthorized');
        }
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        $imageName = $product->image;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated!');
    }

    // Delete
    public function destroy(Product $product)
    {
        $admin = auth('admin')->user();
        if ($product->shop_id !== $admin->shop_id) {
            dd('Shop ID mismatch: Product shop_id = ' . $product->shop_id . ', Admin shop_id = ' . $admin->shop_id);
        }
        if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
            unlink(public_path('uploads/products/' . $product->image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted!');
    }
}
