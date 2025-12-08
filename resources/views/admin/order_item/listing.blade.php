@extends('admin.layouts.master')

@section('title', 'Order Items | ApnaPanda')

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
            <h2 class="role-page-title">Order Items</h2>
            <p class="role-page-subtitle">Manage individual items within orders.</p>
        </div>
        <div class="role-header-actions">
            @if(validatePermissions('admin/order-items/store'))
                <button class="role-btn-primary-gradient" id="orderItemAdd">
                    <i class="bi bi-plus-lg"></i> Add Order Item
                </button>
            @endif
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
                    <td>{{ $item->productCategory->name ?? 'N/A' }}</td>
                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>PKR {{ number_format($item->unit_price) }}</td>
                    <td>PKR {{ number_format($item->unit_price * $item->quantity) }}</td>
                    <td>
                        <div class="role-action-buttons">
                            @if(validatePermissions('admin/order-items/edit/{id}'))
                                <button class="role-btn-icon role-btn-edit editOrderItem" title="Edit" data-id="{{ $item->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            @endif

                            @if(validatePermissions('admin/order-items/delete/{id}'))
                                <button class="role-btn-icon role-btn-delete deleteOrderItem" title="Delete" data-id="{{ $item->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('admin.order_item.add')
    @include('admin.order_item.edit')

</div>

@endsection

@section('footer')
    @include('admin.includes.footer')
@endsection

@push('scripts')
    <script src="{{ asset('admin/js/order_item.js') }}"></script>
@endpush
