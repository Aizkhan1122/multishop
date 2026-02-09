@extends('admin.layout.admin')

@section('title', 'Invoice #' . $order->id)

@section('content')
<div class="invoice p-4 border" style="max-width:800px; margin:auto; font-family:Arial,sans-serif;">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>{{ $companyName }}</h2>
            <p>{{ $companyAddress }}<br>Email: {{ $companyEmail }}</p>
        </div>
        <div>
            @if(!empty($settings['logo']))
                <img src="{{ asset('uploads/' . $settings['logo']) }}" alt="Logo" style="max-width:120px;">
            @endif
        </div>
    </div>

    <hr>

    {{-- Invoice Info --}}
    <div class="mb-4">
        <h4>Invoice #: {{ $order->id }}</h4>
        <p>Date: {{ $order->created_at->format('d M Y') }}<br>Status: {{ ucfirst($order->status) }}</p>
    </div>

    {{-- Customer Info --}}
    <div class="mb-4">
        <h4>Bill To:</h4>
        <p>{{ $order->user->name }}<br>{{ $order->user->email }}<br>
        @if($order->shipping_address) {{ $order->shipping_address }} @endif</p>
    </div>

    {{-- Order Items --}}
    <table class="table table-bordered mb-4" style="width:100%; border-collapse:collapse;">
        <thead>
            <tr style="background:#f2f2f2;">
                <th style="padding:8px; border:1px solid #ddd;">Product</th>
                <th style="padding:8px; border:1px solid #ddd;">Qty</th>
                <th style="padding:8px; border:1px solid #ddd;">Price</th>
                <th style="padding:8px; border:1px solid #ddd;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td style="padding:8px; border:1px solid #ddd;">{{ $item->product->name }}</td>
                <td style="padding:8px; border:1px solid #ddd;">{{ $item->quantity }}</td>
                <td style="padding:8px; border:1px solid #ddd;">${{ number_format($item->price,2) }}</td>
                <td style="padding:8px; border:1px solid #ddd;">${{ number_format($item->quantity * $item->price,2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Totals --}}
    <div style="max-width:300px; float:right;">
        <table class="table" style="width:100%; border-collapse:collapse;">
            <tbody>
                <tr>
                    <td style="padding:6px; border:1px solid #ddd;">Subtotal:</td>
                    <td style="padding:6px; border:1px solid #ddd;">${{ number_format($order->subtotal,2) }}</td>
                </tr>
                <tr>
                    <td style="padding:6px; border:1px solid #ddd;">Discount:</td>
                    <td style="padding:6px; border:1px solid #ddd;">-${{ number_format($order->discount,2) }}</td>
                </tr>
                <tr>
                    <td style="padding:6px; border:1px solid #ddd;">Shipping:</td>
                    <td style="padding:6px; border:1px solid #ddd;">${{ number_format($order->shipping,2) }}</td>
                </tr>
                <tr>
                    <td style="padding:6px; border:1px solid #ddd;">Tax:</td>
                    <td style="padding:6px; border:1px solid #ddd;">${{ number_format($order->tax,2) }}</td>
                </tr>
                <tr style="font-weight:bold; background:#f9f9f9;">
                    <td style="padding:6px; border:1px solid #ddd;">Total:</td>
                    <td style="padding:6px; border:1px solid #ddd;">${{ number_format($order->total,2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="clear:both;"></div>

    {{-- Footer --}}
    <div style="text-align:center; font-size:12px; color:#888; margin-top:30px;">
        Thank you for your purchase!
    </div>

    {{-- Download PDF --}}
    <div class="mt-3" style="text-align:center;">
        <a href="{{ route('admin.invoices.download', $order->id) }}" class="btn btn-success">Download PDF</a>
    </div>
</div>
@endsection
