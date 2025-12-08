@extends('admin.layouts.master')

@section('title', 'Order Details #' . $order->id . ' | ApnaPanda')

@section('sidebar')
    @include('admin.includes.sidebar')
@endsection

@section('header')
    @include('admin.includes.header')
@endsection

@section('content')

<div class="role-dashboard-container">

    {{-- HEADER --}}
    <div class="role-header-card mb-4">
        <div class="role-header-left">
            <h2 class="role-page-title">Order #{{ $order->id }}</h2>
            <p class="role-page-subtitle">Placed on {{ $order->created_at->format('d M Y, h:i A') }}</p>
        </div>
        <div class="role-header-actions">
            @php
                $badges = [
                    'pending' => 'bg-warning text-dark',
                    'processing' => 'bg-info text-white',
                    'completed' => 'bg-success',
                    'cancelled' => 'bg-danger'
                ];
                $badgeClass = $badges[$order->order_status] ?? 'bg-secondary';
            @endphp
            <span class="badge {{ $badgeClass }} fs-6 px-3 py-2">{{ ucfirst($order->order_status) }}</span>
            
            @if(validatePermissions('admin/orders/edit/{id}'))
                <button class="role-btn-primary-gradient editOrder ms-2" data-id="{{ $order->id }}">
                    <i class="bi bi-pencil"></i> Edit Status
                </button>
            @endif
        </div>
    </div>

    {{-- CONTENT GRID --}}
    <div class="row">
        
        {{-- LEFT COLUMN --}}
        <div class="col-lg-8">
            
            <!-- Order Items -->
            <div class="role-table-card mb-4">
                <div class="role-table-header">
                    <h3 class="role-table-title">Order Items</h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Cost</th>
                                <th>Qty</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        {{-- Assuming product has image logic --}}
                                        <div class="bg-light rounded p-1 me-2" style="width: 40px; height: 40px; display:flex; align-items:center; justify-content:center;">
                                            <i class="bi bi-box text-muted"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $item->product->name ?? 'Unknown Product' }}</h6>
                                            {{-- <small class="text-muted">Size: M</small> --}}
                                        </div>
                                    </div>
                                </td>
                                <td>PKR {{ number_format($item->price) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="text-end fw-bold">PKR {{ number_format($item->price * $item->quantity) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end">Subtotal</td>
                                <td class="text-end">PKR {{ number_format($order->payment_amount) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Grand Total</td>
                                <td class="text-end fw-bold fs-5">PKR {{ number_format($order->payment_amount) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Order Logs -->
            <div class="role-table-card">
                <div class="role-table-header">
                    <h3 class="role-table-title">Order History</h3>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($order->statusLogs as $log)
                        <li class="list-group-item d-flex justify-content-between align-items-start py-3">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold text-dark">
                                    {{ $log->old_status }} <i class="bi bi-arrow-right mx-1 text-muted"></i> {{ $log->status_changed_to }}
                                </div>
                                <small class="text-muted">Changed by {{ $log->user_type == 'admin' ? ($log->admin->name ?? 'Admin') : ($log->user->name ?? 'System') }} ({{ $log->user_type }})</small>
                                @if($log->notes)
                                    <div class="mt-1 text-muted fst-italic"><small>"{{ $log->notes }}"</small></div>
                                @endif
                            </div>
                            <span class="badge bg-light text-dark rounded-pill">{{ $log->created_at->format('d M, h:i A') }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted text-center py-3">No history available</li>
                    @endforelse
                </ul>
            </div>

        </div>

        {{-- RIGHT COLUMN --}}
        <div class="col-lg-4">
            
            <!-- Customer Details -->
            <div class="role-table-card mb-4">
                <div class="role-table-header">
                    <h3 class="role-table-title">Customer Details</h3>
                </div>
                <div class="p-3">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; font-size: 1.2rem;">
                            {{ substr($order->customer->name ?? 'U', 0, 1) }}
                        </div>
                        <div>
                            <h5 class="mb-0">{{ $order->customer->name ?? 'N/A' }}</h5>
                            <small class="text-muted">{{ $order->customer->email ?? 'No Email' }}</small>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-2">
                        <i class="bi bi-geo-alt me-2 text-primary"></i> 
                        <span class="text-muted">{{ $order->delivery_address ?? 'No Address' }}</span>
                    </div>
                     <div class="mb-2">
                        <i class="bi bi-telephone me-2 text-primary"></i> 
                        <span class="text-muted">{{ $order->customer->phone ?? 'No Phone' }}</span>
                    </div>
                </div>
            </div>

            <!-- Vendor Details -->
            <div class="role-table-card mb-4">
                <div class="role-table-header">
                    <h3 class="role-table-title">Vendor Details</h3>
                </div>
                <div class="p-3">
                     <div class="d-flex align-items-center mb-3">
                         <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; font-size: 1.2rem;">
                            <i class="bi bi-shop"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">{{ $order->vendor->users->name ?? 'Unknown' }}</h5>
                            <small class="text-muted">Store ID: #{{ $order->vendor_id }}</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Info -->
            <div class="role-table-card">
                 <div class="role-table-header">
                    <h3 class="role-table-title">Payment Info</h3>
                </div>
                <div class="p-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Method:</span>
                        <span class="fw-bold">{{ $order->paymentMethod->payment_methode ?? 'Cash' }}</span>
                    </div>
                     <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Total:</span>
                        <span class="fw-bold text-success">PKR {{ number_format($order->payment_amount) }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    @include('admin.order.edit')

</div>

@endsection

@section('footer')
    @include('admin.includes.footer')
@endsection

@push('scripts')
    <script src="{{ asset('admin/js/order.js') }}"></script>
    <script>
        // Use existing map logic if needed, but detail view usually is read-only for map unless edited
         function initAllAutocompletes() {
             // Initialize map logic if edit drawer is opened, leveraging order.js
             if (typeof initMaps === 'function') { 
                 initMaps(); 
             }
         }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxAPwCneWCcdxQFDOLJ_hGMJk1ruf5AwU&libraries=places&callback=initAllAutocompletes" async defer></script>
@endpush
