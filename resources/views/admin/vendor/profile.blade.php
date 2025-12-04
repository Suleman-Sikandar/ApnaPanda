@extends('admin.layouts.master')

@section('title', 'Vendor Profile | ApnaPanda')

@section('sidebar')
    @include('admin.includes.sidebar')
@endsection

@section('header')
    @include('admin.includes.header')
@endsection

@section('content')

    <div class="role-dashboard-container">

        {{-- HEADER SECTION --}}
        <div class="role-header-card">
            <div class="role-header-left">
                <h2 class="role-page-title">Vendor Profile</h2>
                <p class="role-page-subtitle">View full vendor details and verify documents.</p>
            </div>
            <div class="role-header-actions">
                <a href="{{ route('admin.vendors') }}" class="role-btn-primary-gradient">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>
        </div>

        {{-- BASIC PROFILE + STATUS --}}
        <div class="role-table-card" style="padding: 25px; margin-bottom: 20px;">
            <div class="row">

                {{-- Vendor Profile Image --}}
                <div class="col-md-4 text-center">
                    @if ($vendor->shop_image)
                        <img src="{{ asset('storage/' . $vendor->shop_image) }}" class="img-fluid rounded"
                            style="width: 250px; height: 180px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/placeholders/shops.png') }}" alt="Placeholder" class="img-fluid rounded"
                            style="width: 250px; height: 180px; object-fit: cover;">
                    @endif

                    <h5 class="mt-3">{{ $vendor->business_name ?? 'N/A' }}</h5>

                    {{-- Status Badges --}}
                    <div class="mt-2">
                        {{-- <span class="badge bg-{{ $vendor->verified ? 'success' : 'secondary' }}">
                            {{ $vendor->verified ? 'Verified' : 'Not Verified' }}
                        </span> --}}

                        <span class="badge bg-{{ $vendor->is_face_verified ? 'success' : 'warning' }}">
                            {{ $vendor->is_face_verified ? 'Face Verified' : 'Face Not Verified' }}
                        </span>
                    </div>
                </div>

                {{-- Vendor Summary --}}
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th>Business Name</th>
                            <td>{{ $vendor->business_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Business Type</th>
                            <td>{{ $vendor->business_type ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>{{ $vendor->category ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Business Email</th>
                            <td>{{ $vendor->business_email ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Business Phone</th>
                            <td>{{ $vendor->business_phone ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Registered On</th>
                            <td>{{ $vendor->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>


        {{-- BUSINESS DETAILS --}}
        <div class="role-table-card" style="padding: 25px; margin-bottom:20px;">
            <h4 class="mb-3">Business Details</h4>
            <table class="table table-striped">
                <tr>
                    <th>Registration Number</th>
                    <td>{{ $vendor->business_registration_number ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>GST Number</th>
                    <td>{{ $vendor->GST_number ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>PAN Number</th>
                    <td>{{ $vendor->PAN_number ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Establishment Year</th>
                    <td>{{ $vendor->establishment_year ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Website URL</th>
                    <td>
                        @if ($vendor->website_url)
                            <a href="{{ $vendor->website_url }}" target="_blank">{{ $vendor->website_url }}</a>
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $vendor->description ?? 'No Description Yet' }}</td>
                </tr>
            </table>
        </div>


        {{-- DOCUMENTS --}}
        <div class="role-table-card" style="padding: 25px; margin-bottom:20px;">
            <h4 class="mb-3">Documents</h4>
            <div class="row">

                @php
                    $docs = [
                        'CNIC Front' => $vendor->cnic_front,
                        'CNIC Back' => $vendor->cnic_back,
                        'Registration Certificate' => $vendor->registration_certificate,
                        'GST Certificate' => $vendor->GST_certificate,
                        'PAN Card' => $vendor->PAN_card,
                    ];
                @endphp

                @foreach ($docs as $label => $file)
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <h6>{{ $label }}</h6>

                                @if ($file)
                                    <img src="{{ asset('storage/' . $file) }}" class="img-fluid rounded mb-2"
                                        style="height: 140px; object-fit: cover;">

                                    <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                        class="btn btn-sm btn-primary">
                                        View
                                    </a>
                                @else
                                    <span class="text-muted">Not Uploaded</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>


        {{-- BANK DETAILS --}}
        <div class="role-table-card" style="padding: 25px; margin-bottom:20px;">
            <h4 class="mb-3">Bank Details</h4>
            <table class="table table-bordered">
                <tr>
                    <th>Account Holder</th>
                    <td>{{ $vendor->account_holder_name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Account Number</th>
                    <td>{{ $vendor->account_number ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Bank Name</th>
                    <td>{{ $vendor->bank_name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>IFSC Code</th>
                    <td>{{ $vendor->IFSC_code ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Branch Name</th>
                    <td>{{ $vendor->branch_name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Account Type</th>
                    <td>{{ $vendor->account_type ?? 'N/A' }}</td>
                </tr>
            </table>
        </div>


        {{-- LOCATION DETAILS --}}
        <div class="role-table-card" style="padding: 25px; margin-bottom:20px;">
            <h4 class="mb-3">Store Location</h4>
            <table class="table table-striped">
                <tr>
                    <th>Address</th>
                    <td>{{ $vendor->address ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>City</th>
                    <td>{{ $vendor->city ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Province</th>
                    <td>{{ $vendor->province ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Postal Code</th>
                    <td>{{ $vendor->postal_code ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Country</th>
                    <td>{{ $vendor->country ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Latitude / Longitude</th>
                    <td>{{ $vendor->latitude ?? 'N/A' }} , {{ $vendor->longitude ?? 'N/A' }}</td>
                </tr>
            </table>
        </div>


        {{-- ADMIN ACTION BUTTONS --}}
        <div class="role-table-card" style="padding: 25px; margin-bottom:20px;">
            <h4 class="mb-3">Actions</h4>

            <div class="d-flex gap-3">

                {{-- Approve --}}
                @if ($vendor->status != "approved")
                    <form action="{{ route('admin.vendors.approve', $vendor->id) }}" method="POST" class="form">
                        @csrf

                        @if (validatePermissions('admin/vendors/approve/{id}'))
                            <button class="btn btn-success">
                                <i class="bi bi-check2-circle"></i> Approve Vendor
                            </button>
                        @endif
                    </form>
                @endif

                {{-- Reject --}}
                    @if (validatePermissions('admin/vendors/reject/{id}'))
                        <button class="btn btn-danger" onclick="window.location='{{ url('admin/vendors/reject', $vendor->id) }}'">
                            <i class="bi bi-x-circle" ></i> Reject Vendor
                        </button>
                    @endif

                {{-- Suspend --}}
               
                    @if (validatePermissions('admin/vendors/suspend/{id}'))
                        <button class="btn btn-warning" onclick="window.location='{{ url('admin/vendors/suspend', $vendor->id)}}'">
                            <i class="bi bi-slash-circle"></i> Suspend Vendor
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
    <script src="{{ asset('admin/js/admin.js') }}"></script>
@endpush
