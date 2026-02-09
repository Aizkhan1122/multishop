@extends('admin.layout.admin')

@section('title', 'Invoices')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Invoices</h1>
            <p class="text-muted mb-0">Manage and view all invoices</p>
        </div>
        <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#generateInvoiceModal">
                <i class="bi bi-plus-lg me-2"></i>Generate Invoice
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-3 p-3 me-3">
                            <i class="bi bi-receipt text-primary fs-4"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Total Invoices</h5>
                            <p class="mb-0 text-muted">{{ $invoices->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 rounded-3 p-3 me-3">
                            <i class="bi bi-currency-dollar text-success fs-4"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Total Revenue</h5>
                            <p class="mb-0 text-muted">${{ number_format($invoices->sum('order.total') ?? 0, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 rounded-3 p-3 me-3">
                            <i class="bi bi-check-circle text-info fs-4"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Paid Invoices</h5>
                            <p class="mb-0 text-muted">{{ $invoices->where('order.status', 'completed')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 rounded-3 p-3 me-3">
                            <i class="bi bi-clock-history text-warning fs-4"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Pending Invoices</h5>
                            <p class="mb-0 text-muted">{{ $invoices->where('order.status', 'pending')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoices Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Invoice List</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Invoice #</th>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->invoice_number ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $invoice->order_id) }}" class="text-decoration-none">
                                    #{{ $invoice->order_id }}
                                </a>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm me-2">
                                        <i class="bi bi-person-circle fs-4"></i>
                                    </div>
                                    <div>
                                        <div class="fw-medium">{{ $invoice->order->user->name ?? 'N/A' }}</div>
                                        <div class="text-muted small">{{ $invoice->order->user->email ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $invoice->created_at->format('d M Y') }}</td>
                            <td>${{ number_format($invoice->order->total ?? 0, 2) }}</td>
                            <td>
                                @if($invoice->order->status == 'completed')
                                    <span class="badge bg-success">Paid</span>
                                @elseif($invoice->order->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($invoice->order->status) }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.invoices.show', $invoice->order_id) }}">
                                                <i class="bi bi-eye me-2"></i>View
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.invoices.download', $invoice->order_id) }}">
                                                <i class="bi bi-download me-2"></i>Download PDF
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="bi bi-send me-2"></i>Send Email
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="#">
                                                <i class="bi bi-trash me-2"></i>Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-receipt fs-1 text-muted mb-3"></i>
                                <h5 class="mb-2">No invoices found</h5>
                                <p class="text-muted mb-0">There are no invoices to display at the moment.</p>
                                @isset($orders)
                                <div class="mt-3">
                                    <p class="mb-2">You have {{ $orders->count() }} orders that can be invoiced:</p>
                                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">
                                        <i class="bi bi-bag-check me-2"></i>View Orders
                                    </a>
                                </div>
                                @endisset
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Generate Invoice Modal -->
<div class="modal fade" id="generateInvoiceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Generate Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Order ID</label>
                        <select class="form-select">
                            <option value="">Select an order</option>
                            @isset($orders)
                                @foreach($orders as $order)
                                <option value="{{ $order->id }}">#{{ $order->id }} - {{ $order->user->name ?? 'N/A' }} (${{ $order->total }})</option>
                                @endforeach
                            @else
                                @foreach(App\Models\Order::with('user')->get() as $order)
                                <option value="{{ $order->id }}">#{{ $order->id }} - {{ $order->user->name ?? 'N/A' }} (${{ $order->total }})</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Invoice Date</label>
                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Generate Invoice</button>
            </div>
        </div>
    </div>
</div>
@endsection