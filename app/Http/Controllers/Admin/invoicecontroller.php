<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    // List all invoices
    public function index()
    {
        // Get all invoices with related data
        $invoices = Invoice::with('order.user')->latest()->get();
        
        // If no invoices exist, get all orders as potential invoices
        if ($invoices->isEmpty()) {
            $orders = Order::with('user')->latest()->get();
            return view('admin.invoices.index', compact('invoices', 'orders'));
        }
        
        return view('admin.invoices.index', compact('invoices'));
    }

    // View invoice in browser
    public function show($orderId)
    {
         $order = Order::with('user', 'items.product')->findOrFail($orderId);

    // Company info and settings
    $companyName = config('app.name');
    $companyAddress = config('app.address', 'Your Address Here');
    $companyEmail = config('app.email', 'info@example.com');

    $settings = [
        'logo' => 'logo.png', // Example, load from DB if you store logo in settings
    ];
        
        return view('admin.invoices.show', compact('order', 'companyName', 'companyAddress', 'companyEmail', 'settings'));
    }

    // Download invoice as PDF
    public function download($orderId)
    {
        $order = Order::with('user', 'items.product')->findOrFail($orderId);

    $companyName = config('app.name');
    $companyAddress = config('app.address', 'Your Address Here');
    $companyEmail = config('app.email', 'info@example.com');

    $settings = [
        'logo' => 'logo.png',
    ];

        $pdf = Pdf::loadView('admin.invoices.show', compact('order', 'companyName', 'companyAddress', 'companyEmail', 'settings'));
        return $pdf->download('invoice_'.$order->id.'.pdf');
    }


}