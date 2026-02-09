@extends('admin.layout.admin')

@section('title', 'Dashboard')
@section('page', 'dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stats-icon bg-white bg-opacity-25 rounded-circle p-3 me-3">
                        <i class="bi bi-people-fill icon-xl"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Users</h5>
                        <p class="card-text fs-4 fw-bold">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stats-icon bg-white bg-opacity-25 rounded-circle p-3 me-3">
                        <i class="bi bi-box-seam-fill icon-xl"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Products</h5>
                        <p class="card-text fs-4 fw-bold">{{ $totalProducts }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stats-icon bg-white bg-opacity-25 rounded-circle p-3 me-3">
                        <i class="bi bi-bag-fill icon-xl"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Orders</h5>
                        <p class="card-text fs-4 fw-bold">{{ $totalOrders }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-danger mb-3">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stats-icon bg-white bg-opacity-25 rounded-circle p-3 me-3">
                        <i class="bi bi-currency-dollar icon-xl"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Revenue</h5>
                        <p class="card-text fs-4 fw-bold">${{ number_format($totalRevenue, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-activity me-2"></i>Recent Activity</h5>
                <button class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-arrow-repeat me-1"></i>Refresh
                </button>
            </div>
            <div class="card-body">
                <div class="activity-timeline">
                    <div class="timeline-item d-flex mb-3">
                        <div class="timeline-icon bg-primary rounded-circle d-flex align-items-center justify-content-center me-3">
                            <i class="bi bi-person-plus-fill text-white"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="mb-1">New User Registered</h6>
                            <p class="mb-1">John Doe joined the platform</p>
                            <small class="text-muted">2 minutes ago</small>
                        </div>
                    </div>
                    <div class="timeline-item d-flex mb-3">
                        <div class="timeline-icon bg-success rounded-circle d-flex align-items-center justify-content-center me-3">
                            <i class="bi bi-cart-check-fill text-white"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="mb-1">New Order Placed</h6>
                            <p class="mb-1">Order #12345 for $245.00</p>
                            <small class="text-muted">1 hour ago</small>
                        </div>
                    </div>
                    <div class="timeline-item d-flex mb-3">
                        <div class="timeline-icon bg-warning rounded-circle d-flex align-items-center justify-content-center me-3">
                            <i class="bi bi-star-fill text-white"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Product Review</h6>
                            <p class="mb-1">New review for Product XYZ</p>
                            <small class="text-muted">3 hours ago</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<h4><i class="bi bi-receipt me-2"></i>Latest Orders</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Total</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($latestOrders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user->name }}</td>
            <td>${{ $order->total }}</td>
            <td>
                @if($order->status == 'completed')
                    <span class="badge bg-success"><i class="bi bi-check-circle-fill me-1"></i>Completed</span>
                @elseif($order->status == 'pending')
                    <span class="badge bg-warning"><i class="bi bi-clock-fill me-1"></i>Pending</span>
                @elseif($order->status == 'cancelled')
                    <span class="badge bg-danger"><i class="bi bi-x-circle-fill me-1"></i>Cancelled</span>
                @else
                    <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                @endif
            </td>
            <td>{{ $order->created_at->format('d M Y') }}</td>
            <td>
                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-eye-fill me-1"></i>View
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection