<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    //  public function index()
    // {
    //     $cartItems = Cart::where('user_id', auth()->id())->get();
    //     return view('cart.index', compact('cartItems'));
    // }

    // public function store(Request $request)
    // {
    //     Cart::create([
    //         'user_id' => auth()->id(),
    //         'product_id' => $request->product_id,
    //         'quantity' => $request->quantity ?? 1,
    //     ]);
    //     return redirect()->route('cart.index');
    // }

     // Show cart
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();
        return view('cart', compact('cartItems')); // <-- if your file is cart.blade.php, not cart/index.blade.php
    }

    // Add to cart via POST form
    public function store(Request $request)
    {
        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity ?? 1,
        ]);

        return redirect()->route('cart.index');
    }

    // Add to cart via GET link
    public function add($id)
    {
        $product = Product::findOrFail($id);

        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        return redirect()->route('cart.index')->with('success', $product->name . ' added to cart!');
    }
}
