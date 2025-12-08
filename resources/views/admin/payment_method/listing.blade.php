@extends('admin.layouts.master')

@section('title', 'Payment Methods | ApnaPanda')

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
            <h2 class="role-page-title">Payment Methods</h2>
            <p class="role-page-subtitle">Manage payment methods for your platform.</p>
        </div>
        <div class="role-header-actions">
            @if(validatePermissions('admin/payment-methods/store'))
                <button class="role-btn-primary-gradient" id="paymentMethodAdd">
                    <i class="bi bi-plus-lg"></i> Add Payment Method
                </button>
            @endif
        </div>
    </div>

    {{-- LISTING --}}
    <div class="role-table-card">
        <div class="role-table-header">
            <h3 class="role-table-title">All Payment Methods</h3>
            <div class="role-table-search">
                <div class="role-search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search payment methods..." id="paymentMethodSearchInput">
                </div>
            </div>
        </div>

        <table class="role-data-table data-table">
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Name</th>
                    <th>Ordering</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paymentMethods as $method)
                <tr>
                    <td style="width: 100px; text-align: center;">
                        @if($method->icon)
                            <img src="{{ asset('storage/' . $method->icon) }}" alt="{{ $method->payment_methode }}" style="height: 40px; border-radius: 4px;">
                        @else
                            <span class="text-muted"><i class="bi bi-image"></i></span>
                        @endif
                    </td>
                    <td><strong>{{ $method->payment_methode }}</strong></td>
                    <td>{{ $method->display_order }}</td>
                    <td>
                        <div class="role-action-buttons">
                            @if(validatePermissions('admin/payment-methods/edit/{id}'))
                                <button class="role-btn-icon role-btn-edit editPaymentMethod" title="Edit" data-id="{{ $method->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            @endif

                            @if(validatePermissions('admin/payment-methods/delete/{id}'))
                                <button class="role-btn-icon role-btn-delete deletePaymentMethod" title="Delete" data-id="{{ $method->id }}">
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

    @include('admin.payment_method.add')
    @include('admin.payment_method.edit')

</div>

@endsection

@section('footer')
    @include('admin.includes.footer')
@endsection

@push('scripts')
    <script src="{{ asset('admin/js/payment_method.js') }}"></script>
@endpush
