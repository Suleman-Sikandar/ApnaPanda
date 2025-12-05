@extends('admin.layouts.master')

@section('title', 'Product Details | ApnaPanda')

@section('sidebar')
    @include('admin.includes.sidebar')
@endsection

@section('header')
    @include('admin.includes.header')
@endsection

@section('content')

<div class="role-dashboard-container">

    {{-- HEADER --}}
    <div class="role-header-card">
        <div class="role-header-left">
            <h2 class="role-page-title">Product Details</h2>
            <p class="role-page-subtitle">View full product details including vendor and category info.</p>
        </div>
        <div class="role-header-actions">
            <a href="{{ route('admin.products') }}" class="role-btn-primary-gradient">
                <i class="bi bi-arrow-left"></i> Back to Product List
            </a>
        </div>
    </div>

    {{-- PRODUCT BASIC DETAILS --}}
    <div class="role-table-card" style="padding: 25px; margin-bottom:20px;">
        <h4 class="mb-3">Product Details</h4>
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td>{{ $product->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Price</th>
                <td>${{ number_format($product->price, 2) ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    @if($product->status === 'active')
                        <span class="badge bg-success">Active</span>
                    @elseif($product->status === 'out_of_stock')
                        <span class="badge bg-warning text-dark">Out of Stock</span>
                    @elseif($product->status === 'pending_review')
                        <span class="badge bg-info text-dark">Pending Review</span>
                    @elseif($product->status === 'banned')
                        <span class="badge bg-danger">Banned</span>
                    @else
                        <span class="badge bg-secondary">Unknown</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Created On</th>
                <td>{{ $product->created_at->format('d M Y, h:i A') }}</td>
            </tr>
        </table>
    </div>

    {{-- CATEGORY DETAILS --}}
    <div class="role-table-card" style="padding: 25px; margin-bottom:20px;">
        <h4 class="mb-3">Category Details</h4>
        <table class="table table-bordered">
            <tr>
                <th>Category Name</th>
                <td>{{ $product->category->category_name ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    {{-- VENDOR DETAILS --}}
    <div class="role-table-card" style="padding: 25px; margin-bottom:20px;">
        <h4 class="mb-3">Vendor Details</h4>
        <table class="table table-bordered">
            <tr>
                <th>Vendor Name</th>
                <td>{{ $product->vendor->users->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Vendor Business Name</th>
                <td>{{ $product->vendor->business_name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $product->vendor->business_email ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $product->vendor->business_phone ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    {{-- PRODUCT IMAGES --}}
    <div class="role-table-card" style="padding: 25px; margin-bottom:20px;">
        <h4 class="mb-3">Product Images</h4>
        <div class="row">
            @if($product->images && count($product->images) > 0)
                <div id="productImageCarousel" class="carousel slide" data-bs-ride="carousel" style="max-width: 600px; margin: 0 auto;">
                    <div class="carousel-inner">
                        @foreach($product->images as $key => $image)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $image->image_path) }}" class="d-block w-100 rounded" 
                                     style="height: 400px; object-fit: cover;" alt="Product Image">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productImageCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: rgba(0,0,0,0.5); border-radius: 50%;"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productImageCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: rgba(0,0,0,0.5); border-radius: 50%;"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            @else
                <p class="text-muted">No images uploaded for this product.</p>
            @endif
        </div>
    </div>

    {{-- ACTIONS --}}
    <div class="role-table-card" style="padding: 25px; margin-bottom:20px;">
        <h4 class="mb-3">Actions</h4>
        <div class="d-flex gap-3 flex-wrap">
            @if(validatePermissions('admin/products/edit/{id}'))
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Edit Product
                </a>
            @endif

            {{-- Status Actions --}}
            @if(validatePermissions('admin/products/status/{id}'))
                
                {{-- Mark Active --}}
                @if($product->status !== 'active')
                    <form action="{{ route('admin.products.active', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Mark Active
                        </button>
                    </form>
                @endif

                {{-- Mark Out of Stock --}}
                @if($product->status !== 'out_of_stock')
                    <form action="{{ route('admin.products.outOfStock', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning text-dark">
                            <i class="bi bi-exclamation-triangle"></i> Mark Out of Stock
                        </button>
                    </form>
                @endif

                {{-- Mark Pending --}}
                @if($product->status !== 'pending_review')
                    <form action="{{ route('admin.products.pending', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-info text-dark">
                            <i class="bi bi-clock"></i> Mark Pending Review
                        </button>
                    </form>
                @endif

                {{-- Ban Product --}}
                @if($product->status !== 'banned')
                    <a href="{{ route('admin.products.ban', $product->id) }}" class="btn btn-danger">
                        <i class="bi bi-ban"></i> Ban Product
                    </a>
                @endif

            @endif

            @if(validatePermissions('admin/products/delete/{id}'))
                <button class="btn btn-danger" onclick="window.location='{{ url('admin/products/delete', $product->id) }}'">
                    <i class="bi bi-trash"></i> Delete Product
                </button>
            @endif
        </div>
    </div>

</div>
@endsection

@section('footer')
    @include('admin.includes.footer')
@endsection

@push('scripts')
    <script src="{{ asset('admin/js/product.js') }}"></script>
@endpush
