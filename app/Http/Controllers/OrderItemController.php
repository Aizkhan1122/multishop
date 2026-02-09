<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;

class OrderItemController extends Controller
{
    public function index()
    {
        $items = OrderItem::all();
        return view('order_items.index', compact('items'));
    }
}
