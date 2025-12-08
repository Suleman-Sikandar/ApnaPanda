@extends('vendor.master')

@section('title', 'Order Items | ApnaPanda')

@section('sidebar')
    @include('vendor.include.sidebar')
@endsection

@section('header')
    @include('vendor.include.header')
@endsection

@section('content')

<div class="role-dashboard-container">

    {{-- HEADER --}}
    <div class="role-header-card">
        <div class="role-header-left">
            <h2 class="role-page-title">Order Items</h2>
            <p class="role-page-subtitle">Manage individual items within your orders.</p>
        </div>
        <div class="role-header-actions">
            <button class="role-btn-primary-gradient" id="orderItemAdd">
                <i class="bi bi-plus-lg"></i> Add Order Item
            </button>
        </div>
    </div>

    {{-- LISTING --}}
    <div class="role-table-card">
        <div class="role-table-header">
            <h3 class="role-table-title">All Order Items</h3>
            <div class="role-table-search">
                <div class="role-search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search items..." id="orderItemSearchInput">
                </div>
            </div>
        </div>

        <table class="role-data-table data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Category</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderItems as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>#{{ $item->order_id }}</td>
                    <td>{{ $item->productCategory->category_name ?? 'N/A' }}</td>
                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>PKR {{ number_format($item->unit_price) }}</td>
                    <td>PKR {{ number_format($item->unit_price * $item->quantity) }}</td>
                    <td>
                        <div class="role-action-buttons">
                            <button class="role-btn-icon role-btn-edit editOrderItem" title="Edit" data-id="{{ $item->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <button class="role-btn-icon role-btn-delete deleteOrderItem" title="Delete" data-id="{{ $item->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('vendor.order_item.add')
    @include('vendor.order_item.edit')

</div>

@endsection

@push('scripts')
    <script src="{{ asset('vendor/js/order_item.js') }}"></script>
@endpush
