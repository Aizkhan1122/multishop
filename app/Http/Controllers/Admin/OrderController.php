<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // ORDER LIST
    public function index()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // ORDER DETAILS
    public function show(Order $order)
    {
        $order->load('user'); // load user relation
        return view('admin.orders.show', compact('order'));
    }

    // UPDATE ORDER STATUS
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Order status updated successfully!');
    }

    // DELETE ORDER
    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success', 'Order deleted!');
    }
}
