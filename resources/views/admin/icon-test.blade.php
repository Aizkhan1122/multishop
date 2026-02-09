@extends('admin.layout.admin')

@section('title', 'Icon Test')

@section('content')
<div class="container-fluid p-4">
    <h1>Icon Test Page</h1>
    <p>This page tests if Bootstrap icons are loading correctly.</p>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Common Icons</h5>
                </div>
                <div class="card-body">
                    <p><i class="bi bi-house me-2"></i> House Icon</p>
                    <p><i class="bi bi-person me-2"></i> Person Icon</p>
                    <p><i class="bi bi-gear me-2"></i> Gear Icon</p>
                    <p><i class="bi bi-heart me-2"></i> Heart Icon</p>
                    <p><i class="bi bi-star me-2"></i> Star Icon</p>
                    <p><i class="bi bi-search me-2"></i> Search Icon</p>
                    <p><i class="bi bi-download me-2"></i> Download Icon</p>
                    <p><i class="bi bi-upload me-2"></i> Upload Icon</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Dashboard Related Icons</h5>
                </div>
                <div class="card-body">
                    <p><i class="bi bi-speedometer2 me-2"></i> Dashboard Icon</p>
                    <p><i class="bi bi-people me-2"></i> Users Icon</p>
                    <p><i class="bi bi-box me-2"></i> Products Icon</p>
                    <p><i class="bi bi-receipt me-2"></i> Orders Icon</p>
                    <p><i class="bi bi-graph-up me-2"></i> Analytics Icon</p>
                    <p><i class="bi bi-shield-check me-2"></i> Security Icon</p>
                    <p><i class="bi bi-question-circle me-2"></i> Help Icon</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection