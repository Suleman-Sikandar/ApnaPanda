@extends('customer.master')

@section('title', 'Vendor Profile | ApnaPanda')
@section('vendorNav')
    @include('customer.includes.vendor_nav')
@endsection

@section('content')
    <div class="profile-container">
        <div class="container">
            <div class="profile-layout">
                <!-- Sidebar -->
                <aside class="profile-sidebar">
                    <!-- Profile Card -->
                    <div class="profile-card">
                        <div class="profile-avatar" id="profileSidebarAvatar"
                            style="background-size: cover; background-position: center; width:120px; height:120px; border-radius:50%; cursor:pointer; background-image: url('{{ $vendor->profile_image ? asset('storage/' . $vendor->profile_image) : asset('/mnt/data/c083e360-8194-46ab-b166-ad3e59d4dea8.png') }}');"
                            title="View Profile Photo"
                            onclick="openImageModal('{{ $vendor->profile_image ? asset('storage/' . $vendor->profile_image) : asset('/mnt/data/c083e360-8194-46ab-b166-ad3e59d4dea8.png') }}')">
                        </div>

                        <!-- Verification Badge -->
                        <div style="text-align: center; margin-top: 10px;">
                            @if($vendor->is_face_verified)
                                <span style="background: #10b981; color: white; padding: 5px 15px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                    <i class="fas fa-check-circle"></i> Verified
                                </span>
                            @else
                                <span style="background: #6b7280; color: white; padding: 5px 15px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                    <i class="fas fa-exclamation-circle"></i> Not Verified
                                </span>
                            @endif
                        </div>

                        <!-- Modal -->
                        <div id="imageModal"
                            style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); justify-content:center; align-items:center; z-index:9999;">
                            <img id="modalImage" src=""
                                style="max-width:400px; max-height:400px; border-radius:50%; box-shadow:0 0 15px rgba(0,0,0,0.5);">
                        </div>

                        <div class="profile-name">{{ $vendor->business_name ?? $vendor->name }}</div>
                        <div class="profile-email">{{ $vendor->email }}</div>
                        <div class="profile-stats">
                            <div class="stat-item">
                                <div class="stat-value">{{ $vendor->total_products ?? 0 }}</div>
                                <div class="stat-label">Products</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">{{ $vendor->rating ?? '0.0' }}</div>
                                <div class="stat-label">Rating</div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="profile-menu">
                        <a href="{{ route('vendor.profile', $vendor->id) }}" class="menu-item {{ $activeSection == 'profile' ? 'active' : '' }}">
                            <i class="fas fa-user"></i>
                            <span>Personal Info</span>
                        </a>
                        
                        @php
                            $allStepsComplete = $vendor->current_step >= 7;
                        @endphp

                        <a href="{{ ($vendor->current_step >= 2 || $allStepsComplete) ? route('vendor.business.info', $vendor->id) : '#' }}" 
                           class="menu-item {{ $activeSection == 'business' ? 'active' : '' }} {{ ($vendor->current_step < 2 && !$allStepsComplete) ? 'disabled' : '' }}"
                           style="{{ ($vendor->current_step < 2 && !$allStepsComplete) ? 'opacity: 0.5; cursor: not-allowed;' : '' }}">
                            <i class="fas fa-building"></i>
                            <span>Business Info</span>
                            @if($vendor->current_step < 2 && !$allStepsComplete) <i class="fas fa-lock" style="float: right; margin-top: 4px; font-size: 12px;"></i> @endif
                        </a>

                        <a href="{{ ($vendor->current_step >= 3 || $allStepsComplete) ? route('vendor.documents', $vendor->id) : '#' }}" 
                           class="menu-item {{ $activeSection == 'documents' ? 'active' : '' }} {{ ($vendor->current_step < 3 && !$allStepsComplete) ? 'disabled' : '' }}"
                           style="{{ ($vendor->current_step < 3 && !$allStepsComplete) ? 'opacity: 0.5; cursor: not-allowed;' : '' }}">
                            <i class="fas fa-file-alt"></i>
                            <span>Documents</span>
                            @if($vendor->current_step < 3 && !$allStepsComplete) <i class="fas fa-lock" style="float: right; margin-top: 4px; font-size: 12px;"></i> @endif
                        </a>

                        <a href="{{ ($vendor->current_step >= 4 || $allStepsComplete) ? route('vendor.bank', $vendor->id) : '#' }}" 
                           class="menu-item {{ $activeSection == 'bank' ? 'active' : '' }} {{ ($vendor->current_step < 4 && !$allStepsComplete) ? 'disabled' : '' }}"
                           style="{{ ($vendor->current_step < 4 && !$allStepsComplete) ? 'opacity: 0.5; cursor: not-allowed;' : '' }}">
                            <i class="fas fa-university"></i>
                            <span>Bank Details</span>
                            @if($vendor->current_step < 4 && !$allStepsComplete) <i class="fas fa-lock" style="float: right; margin-top: 4px; font-size: 12px;"></i> @endif
                        </a>

                        <a href="{{ ($vendor->current_step >= 5 || $allStepsComplete) ? route('vendor.address', $vendor->id) : '#' }}" 
                           class="menu-item {{ $activeSection == 'addresses' ? 'active' : '' }} {{ ($vendor->current_step < 5 && !$allStepsComplete) ? 'disabled' : '' }}"
                           style="{{ ($vendor->current_step < 5 && !$allStepsComplete) ? 'opacity: 0.5; cursor: not-allowed;' : '' }}">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Address</span>
                            @if($vendor->current_step < 5 && !$allStepsComplete) <i class="fas fa-lock" style="float: right; margin-top: 4px; font-size: 12px;"></i> @endif
                        </a>

                        <a href="{{ ($vendor->current_step >= 6 || $allStepsComplete) ? route('vendor.face.verification', $vendor->id) : '#' }}" 
                           class="menu-item {{ $activeSection == 'face_verification' ? 'active' : '' }} {{ ($vendor->current_step < 6 && !$allStepsComplete) ? 'disabled' : '' }}"
                           style="{{ ($vendor->current_step < 6 && !$allStepsComplete) ? 'opacity: 0.5; cursor: not-allowed;' : '' }}">
                            <i class="fas fa-camera"></i>
                            <span>Face Verification</span>
                            @if($vendor->current_step < 6 && !$allStepsComplete) <i class="fas fa-lock" style="float: right; margin-top: 4px; font-size: 12px;"></i> @endif
                        </a>

                        <a href="{{ route('vendor.security', $vendor->id) }}" class="menu-item {{ $activeSection == 'security' ? 'active' : '' }}">
                            <i class="fas fa-shield-alt"></i>
                            <span>Security</span>
                        </a>
                    </nav>
                </aside>

                <!-- Content Area -->
                <main class="profile-content">
                    <!-- Personal Info Section -->
                    <div id="profile-section" class="content-section" style="display: {{ $activeSection == 'profile' ? 'block' : 'none' }};">
                        <div class="section-header">
                            <h2 class="section-title">Personal Information</h2>
                            <p style="color: #6b7280; font-size: 14px;">Update your personal details</p>
                        </div>
                        <form id="profile-form" action="{{ url('vendor/business-profile-store/' . $vendor->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-grid">

                                <!-- Name -->
                                <div class="form-group">
                                    <label class="form-label">Full Name <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name', $vendor->name) }}" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label class="form-label">Email Address <span style="color:red;">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email', $vendor->email) }}" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div class="form-group">
                                    <label class="form-label">Phone Number <span style="color:red;">*</span></label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ old('phone', $vendor->phone ?? '') }}" required>
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Alternative Phone -->
                                <div class="form-group">
                                    <label class="form-label">Alternative Phone</label>
                                    <input type="tel" class="form-control @error('alternative_phone') is-invalid @enderror"
                                        name="alternative_phone" value="{{ old('alternative_phone', $vendor->alternative_phone ?? '') }}">
                                    @error('alternative_phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Date of Birth -->
                                <div class="form-group">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                        name="date_of_birth"
                                        value="{{ old('date_of_birth', $vendor->date_of_birth ? \Carbon\Carbon::parse($vendor->date_of_birth)->format('Y-m-d') : '') }}">
                                    @error('date_of_birth')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Gender -->
                                <div class="form-group">
                                    <label class="form-label">Gender</label>
                                    <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="Male" {{ old('gender', $vendor->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender', $vendor->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ old('gender', $vendor->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Profile Image -->
                                <div class="form-group" style="grid-column: 1 / -1;">
                                    <label class="form-label">Profile Image</label>
                                    <input type="file" id="profileImageInput" name="profile_image" accept="image/*"
                                        style="display:none;">
                                    <button type="button" id="openImagePicker" class="btn btn-primary">
                                        <i class="fas fa-upload"></i> Upload Image
                                    </button>
                                    @error('profile_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    <!-- Cropping Preview -->
                                    <div id="cropContainer" style="display:none; margin-top: 15px;">
                                        <h5>Adjust Your Image</h5>
                                        <img id="cropperImage" style="max-width:100%; border-radius:10px;">
                                        <div style="margin-top:10px;">
                                            <button type="button" id="cropImageBtn" class="btn btn-success">
                                                <i class="fas fa-check"></i> Save
                                            </button>
                                            <button type="button" id="cancelCropBtn" class="btn btn-danger">
                                                <i class="fas fa-times"></i> Cancel
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Final Preview -->
                                    <div style="margin-top: 15px;">
                                        <img id="profilePreviewForm" src="{{ $vendor->profile_image ? asset('storage/' . $vendor->profile_image) : '' }}"
                                            style="display: {{ $vendor->profile_image ? 'block' : 'none' }}; max-width: 150px; border-radius: 10px;">
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="save-btn">
                                <i class="fas fa-arrow-right"></i> Save & Next
                            </button>
                        </form>
                    </div>

                    <!-- Business Info Section -->
                    <div id="business-section" class="content-section" style="display: {{ $activeSection == 'business' ? 'block' : 'none' }};">
                        <div class="section-header">
                            <h2 class="section-title">Business Information</h2>
                            <p style="color: #6b7280; font-size: 14px;">Tell us about your business</p>
                        </div>
                        <form action="{{ url('vendor/business-info-store/' . $vendor->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-grid">

                                <!-- Business Name -->
                                <div class="form-group">
                                    <label class="form-label">Business Name <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control @error('business_name') is-invalid @enderror"
                                        name="business_name" value="{{ old('business_name', $vendor->business_name) }}" required>
                                    @error('business_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Business Type -->
                                <div class="form-group">
                                    <label class="form-label">Business Type <span style="color:red;">*</span></label>
                                    <select class="form-control @error('business_type') is-invalid @enderror" name="business_type" required>
                                        <option value="">Select Type</option>
                                        <option value="Sole Proprietorship" {{ old('business_type', $vendor->business_type) == 'Sole Proprietorship' ? 'selected' : '' }}>Sole Proprietorship</option>
                                        <option value="Partnership" {{ old('business_type', $vendor->business_type) == 'Partnership' ? 'selected' : '' }}>Partnership</option>
                                        <option value="Private Limited" {{ old('business_type', $vendor->business_type) == 'Private Limited' ? 'selected' : '' }}>Private Limited</option>
                                        <option value="Public Limited" {{ old('business_type', $vendor->business_type) == 'Public Limited' ? 'selected' : '' }}>Public Limited</option>
                                    </select>
                                    @error('business_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Category -->
                                <div class="form-group">
                                    <label class="form-label">Category <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control @error('category') is-invalid @enderror"
                                        name="category" value="{{ old('category', $vendor->category) }}" required>
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Business Registration Number -->
                                <div class="form-group">
                                    <label class="form-label">Business Registration Number</label>
                                    <input type="text" class="form-control @error('business_registration_number') is-invalid @enderror"
                                        name="business_registration_number" value="{{ old('business_registration_number', $vendor->business_registration_number) }}">
                                    @error('business_registration_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- GST Number -->
                                <div class="form-group">
                                    <label class="form-label">GST Number</label>
                                    <input type="text" class="form-control @error('GST_number') is-invalid @enderror"
                                        name="GST_number" value="{{ old('GST_number', $vendor->GST_number) }}">
                                    @error('GST_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- PAN Number -->
                                <div class="form-group">
                                    <label class="form-label">PAN Number</label>
                                    <input type="text" class="form-control @error('PAN_number') is-invalid @enderror"
                                        name="PAN_number" value="{{ old('PAN_number', $vendor->PAN_number) }}">
                                    @error('PAN_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Business Email -->
                                <div class="form-group">
                                    <label class="form-label">Business Email</label>
                                    <input type="email" class="form-control @error('business_email') is-invalid @enderror"
                                        name="business_email" value="{{ old('business_email', $vendor->business_email) }}">
                                    @error('business_email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Business Phone -->
                                <div class="form-group">
                                    <label class="form-label">Business Phone</label>
                                    <input type="tel" class="form-control @error('business_phone') is-invalid @enderror"
                                        name="business_phone" value="{{ old('business_phone', $vendor->business_phone) }}">
                                    @error('business_phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Establishment Year -->
                                <div class="form-group">
                                    <label class="form-label">Establishment Year</label>
                                    <input type="number" class="form-control @error('establishment_year') is-invalid @enderror"
                                        name="establishment_year" value="{{ old('establishment_year', $vendor->establishment_year) }}" min="1900" max="{{ date('Y') }}">
                                    @error('establishment_year')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Website URL -->
                                <div class="form-group">
                                    <label class="form-label">Website URL</label>
                                    <input type="url" class="form-control @error('website_url') is-invalid @enderror"
                                        name="website_url" value="{{ old('website_url', $vendor->website_url) }}">
                                    @error('website_url')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="form-group" style="grid-column: 1 / -1;">
                                    <label class="form-label">Business Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4">{{ old('description', $vendor->description) }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Logo -->
                                <div class="form-group">
                                    <label class="form-label">Business Logo</label>
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" accept="image/*">
                                    @error('logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if($vendor->logo)
                                        <img src="{{ asset('storage/' . $vendor->logo) }}" style="max-width: 100px; margin-top: 10px; border-radius: 5px;">
                                    @endif
                                </div>

                            </div>
                            <button type="submit" class="save-btn">
                                <i class="fas fa-arrow-right"></i> Save & Next
                            </button>
                        </form>
                    </div>

                    <!-- Documents Section -->
                    <div id="documents-section" class="content-section" style="display: {{ $activeSection == 'documents' ? 'block' : 'none' }};">
                        <div class="section-header">
                            <h2 class="section-title">Document Uploads</h2>
                            <p style="color: #6b7280; font-size: 14px;">Upload required documents for verification</p>
                        </div>
                        <form action="{{ url('vendor/documents-store/' . $vendor->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-grid">

                                <!-- CNIC Front -->
                                <div class="form-group">
                                    <label class="form-label">CNIC Front <span style="color:red;">*</span></label>
                                    <input type="file" class="form-control @error('cnic_front') is-invalid @enderror" name="cnic_front" accept="image/*">
                                    @error('cnic_front')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if($vendor->cnic_front)
                                        <img src="{{ asset('storage/' . $vendor->cnic_front) }}" style="max-width: 100px; margin-top: 10px; border-radius: 5px;">
                                    @endif
                                </div>

                                <!-- CNIC Back -->
                                <div class="form-group">
                                    <label class="form-label">CNIC Back <span style="color:red;">*</span></label>
                                    <input type="file" class="form-control @error('cnic_back') is-invalid @enderror" name="cnic_back" accept="image/*">
                                    @error('cnic_back')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if($vendor->cnic_back)
                                        <img src="{{ asset('storage/' . $vendor->cnic_back) }}" style="max-width: 100px; margin-top: 10px; border-radius: 5px;">
                                    @endif
                                </div>

                                <!-- Registration Certificate -->
                                <div class="form-group">
                                    <label class="form-label">Registration Certificate</label>
                                    <input type="file" class="form-control @error('registration_certificate') is-invalid @enderror" name="registration_certificate" accept="image/*,application/pdf">
                                    @error('registration_certificate')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if($vendor->registration_certificate)
                                        <a href="{{ asset('storage/' . $vendor->registration_certificate) }}" target="_blank" class="btn btn-sm btn-info mt-2">View Document</a>
                                    @endif
                                </div>

                                <!-- GST Certificate -->
                                <div class="form-group">
                                    <label class="form-label">GST Certificate</label>
                                    <input type="file" class="form-control @error('GST_certificate') is-invalid @enderror" name="GST_certificate" accept="image/*,application/pdf">
                                    @error('GST_certificate')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if($vendor->GST_certificate)
                                        <a href="{{ asset('storage/' . $vendor->GST_certificate) }}" target="_blank" class="btn btn-sm btn-info mt-2">View Document</a>
                                    @endif
                                </div>

                                <!-- PAN Card -->
                                <div class="form-group">
                                    <label class="form-label">PAN Card</label>
                                    <input type="file" class="form-control @error('PAN_card') is-invalid @enderror" name="PAN_card" accept="image/*,application/pdf">
                                    @error('PAN_card')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if($vendor->PAN_card)
                                        <a href="{{ asset('storage/' . $vendor->PAN_card) }}" target="_blank" class="btn btn-sm btn-info mt-2">View Document</a>
                                    @endif
                                </div>

                                <!-- Shop Image -->
                                <div class="form-group">
                                    <label class="form-label">Shop Image</label>
                                    <input type="file" class="form-control @error('shop_image') is-invalid @enderror" name="shop_image" accept="image/*">
                                    @error('shop_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if($vendor->shop_image)
                                        <img src="{{ asset('storage/' . $vendor->shop_image) }}" style="max-width: 100px; margin-top: 10px; border-radius: 5px;">
                                    @endif
                                </div>

                            </div>
                            <button type="submit" class="save-btn">
                                <i class="fas fa-arrow-right"></i> Save & Next
                            </button>
                        </form>
                    </div>

                    <!-- Bank Details Section -->
                    <div id="bank-section" class="content-section" style="display: {{ $activeSection == 'bank' ? 'block' : 'none' }};">
                        <div class="section-header">
                            <h2 class="section-title">Bank Details</h2>
                            <p style="color: #6b7280; font-size: 14px;">Add your bank account information</p>
                        </div>
                        <form action="{{ url('vendor/bank-store/' . $vendor->id) }}" method="POST">
                            @csrf
                            <div class="form-grid">

                                <!-- Account Holder Name -->
                                <div class="form-group">
                                    <label class="form-label">Account Holder Name <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control @error('account_holder_name') is-invalid @enderror"
                                        name="account_holder_name" value="{{ old('account_holder_name', $vendor->account_holder_name) }}" required>
                                    @error('account_holder_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Account Number -->
                                <div class="form-group">
                                    <label class="form-label">Account Number <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control @error('account_number') is-invalid @enderror"
                                        name="account_number" value="{{ old('account_number', $vendor->account_number) }}" required>
                                    @error('account_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Bank Name -->
                                <div class="form-group">
                                    <label class="form-label">Bank Name <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control @error('bank_name') is-invalid @enderror"
                                        name="bank_name" value="{{ old('bank_name', $vendor->bank_name) }}" required>
                                    @error('bank_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- IFSC Code -->
                                <div class="form-group">
                                    <label class="form-label">IFSC Code <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control @error('IFSC_code') is-invalid @enderror"
                                        name="IFSC_code" value="{{ old('IFSC_code', $vendor->IFSC_code) }}" required>
                                    @error('IFSC_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Branch Name -->
                                <div class="form-group">
                                    <label class="form-label">Branch Name</label>
                                    <input type="text" class="form-control @error('branch_name') is-invalid @enderror"
                                        name="branch_name" value="{{ old('branch_name', $vendor->branch_name) }}">
                                    @error('branch_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Account Type -->
                                <div class="form-group">
                                    <label class="form-label">Account Type <span style="color:red;">*</span></label>
                                    <select class="form-control @error('account_type') is-invalid @enderror" name="account_type" required>
                                        <option value="">Select Type</option>
                                        <option value="Savings" {{ old('account_type', $vendor->account_type) == 'Savings' ? 'selected' : '' }}>Savings</option>
                                        <option value="Current" {{ old('account_type', $vendor->account_type) == 'Current' ? 'selected' : '' }}>Current</option>
                                    </select>
                                    @error('account_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <button type="submit" class="save-btn">
                                <i class="fas fa-arrow-right"></i> Save & Next
                            </button>
                        </form>
                    </div>

                    <!-- Address Section -->
                    <div id="addresses-section" class="content-section" style="display: {{ $activeSection == 'addresses' ? 'block' : 'none' }};">
                        <div class="section-header">
                            <h2 class="section-title">Address Information</h2>
                            <p style="color: #6b7280; font-size: 14px;">Provide your business address</p>
                        </div>
                        <form action="{{ url('vendor/address-store/' . $vendor->id) }}" method="POST">
                            @csrf
                            <div class="form-grid">

                                <!-- Address -->
                                <div class="form-group" style="grid-column: 1 / -1;">
                                    <label class="form-label">Address <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        name="address" id="address-input" value="{{ old('address', $vendor->address) }}" required>
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- City -->
                                <div class="form-group">
                                    <label class="form-label">City <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror"
                                        name="city" value="{{ old('city', $vendor->city) }}" required>
                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Province/State -->
                                <div class="form-group">
                                    <label class="form-label">Province/State <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control @error('province') is-invalid @enderror"
                                        name="province" value="{{ old('province', $vendor->province) }}" required>
                                    @error('province')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Postal Code -->
                                <div class="form-group">
                                    <label class="form-label">Postal Code <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control @error('postal_code') is-invalid @enderror"
                                        name="postal_code" value="{{ old('postal_code', $vendor->postal_code) }}" required>
                                    @error('postal_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Country -->
                                <div class="form-group">
                                    <label class="form-label">Country <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control @error('country') is-invalid @enderror"
                                        name="country" value="{{ old('country', $vendor->country) }}" required>
                                    @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Latitude -->
                                <div class="form-group">
                                    <label class="form-label">Latitude</label>
                                    <input type="text" class="form-control @error('latitude') is-invalid @enderror"
                                        name="latitude" value="{{ old('latitude', $vendor->latitude) }}" readonly>
                                    @error('latitude')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Longitude -->
                                <div class="form-group">
                                    <label class="form-label">Longitude</label>
                                    <input type="text" class="form-control @error('longitude') is-invalid @enderror"
                                        name="longitude" value="{{ old('longitude', $vendor->longitude) }}" readonly>
                                    @error('longitude')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <button type="submit" class="save-btn">
                                <i class="fas fa-arrow-right"></i> Save & Next
                            </button>
                        </form>
                    </div>

                    <!-- Face Verification Section -->
                    <div id="face_verification-section" class="content-section" style="display: {{ $activeSection == 'face_verification' ? 'block' : 'none' }};">
                        <div class="section-header">
                            <h2 class="section-title">Face Verification</h2>
                            <p style="color: #6b7280; font-size: 14px;">Verify your identity to complete registration</p>
                        </div>

                        @if($vendor->is_face_verified)
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> Your identity has been verified successfully!
                            </div>
                        @else
                            <div style="max-width: 600px; margin: 0 auto;">
                                <div style="position: relative; margin-bottom: 20px;">
                                    <video id="video" width="100%" height="400" autoplay style="border-radius: 10px; background: #000;"></video>
                                    <canvas id="overlay" style="position: absolute; top: 0; left: 0; border-radius: 10px;"></canvas>
                                </div>

                                <div id="verification-status" class="alert" style="display: none;"></div>

                                <button type="button" id="start-verification-btn" class="save-btn" style="width: 100%;">
                                    <i class="fas fa-camera"></i> Start Verification
                                </button>
                            </div>
                        @endif
                    </div>

                    <!-- Security Section -->
                    <div id="security-section" class="content-section" style="display: {{ $activeSection == 'security' ? 'block' : 'none' }};">
                        <div class="section-header">
                            <h2 class="section-title">Security Settings</h2>
                            <p style="color: #6b7280; font-size: 14px;">Keep your account secure</p>
                        </div>
                        <form action="{{ url('vendor/password/' . $vendor->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-grid">

                                <!-- Current Password -->
                                <div class="form-group">
                                    <label class="form-label">Current Password <span style="color:red;">*</span></label>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                        name="current_password" required>
                                    @error('current_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div></div>

                                <!-- New Password -->
                                <div class="form-group">
                                    <label class="form-label">New Password <span style="color:red;">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" required>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <label class="form-label">Confirm New Password <span style="color:red;">*</span></label>
                                    <input type="password" class="form-control"
                                        name="password_confirmation" required>
                                </div>

                            </div>
                            <button type="submit" class="save-btn">
                                <i class="fas fa-lock"></i> Change Password
                            </button>
                        </form>
                    </div>

                </main>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('customer.includes.footer')
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    
    <!-- Face API -->
    <script defer src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
    
    <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxAPwCneWCcdxQFDOLJ_hGMJk1ruf5AwU&libraries=places&callback=initAutocomplete" async defer></script>

    <script>
        // Image Cropper
        let cropper;

        document.getElementById('openImagePicker').addEventListener('click', function() {
            document.getElementById('profileImageInput').click();
        });

        document.getElementById('profileImageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('cropperImage').src = e.target.result;
                document.getElementById('cropContainer').style.display = 'block';

                if (cropper) cropper.destroy();

                cropper = new Cropper(document.getElementById('cropperImage'), {
                    aspectRatio: 1,
                    viewMode: 2,
                    autoCropArea: 1
                });
            };
            reader.readAsDataURL(file);
        });

        document.getElementById('cancelCropBtn').onclick = function() {
            document.getElementById('cropContainer').style.display = 'none';
            if (cropper) cropper.destroy();
        };

        document.getElementById('cropImageBtn').onclick = function() {
            const canvas = cropper.getCroppedCanvas({
                width: 300,
                height: 300
            });

            const croppedImg = canvas.toDataURL('image/png');

            // Set preview image
            document.getElementById('profilePreviewForm').src = croppedImg;
            document.getElementById('profilePreviewForm').style.display = 'block';

            // Update sidebar
            document.getElementById('profileSidebarAvatar').style.backgroundImage = `url(${croppedImg})`;

            // Save cropped image to hidden input
            const imgInput = document.createElement("input");
            imgInput.type = "hidden";
            imgInput.name = "croppedImage";
            imgInput.value = croppedImg;
            document.querySelector("#profile-form").appendChild(imgInput);

            document.getElementById('cropContainer').style.display = 'none';

            cropper.destroy();
        };

        // Image Modal
        function openImageModal(src) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            modalImg.src = src;
            modal.style.display = 'flex';
        }

        // Close modal when clicking outside the image
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target.id === 'imageModal') {
                this.style.display = 'none';
            }
        });

        // --- Location Autocomplete ---
        function initAutocomplete() {
            const input = document.getElementById('address-input');
            if (!input) return;

            const autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.setFields(['address_components', 'geometry', 'icon', 'name']);

            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // Fill Latitude and Longitude
                document.querySelector('input[name="latitude"]').value = place.geometry.location.lat();
                document.querySelector('input[name="longitude"]').value = place.geometry.location.lng();

                // Fill other fields
                let city = '';
                let state = '';
                let country = '';
                let postal_code = '';

                for (const component of place.address_components) {
                    const componentType = component.types[0];
                    switch (componentType) {
                        case 'locality':
                            city = component.long_name;
                            break;
                        case 'administrative_area_level_1':
                            state = component.long_name;
                            break;
                        case 'country':
                            country = component.long_name;
                            break;
                        case 'postal_code':
                            postal_code = component.long_name;
                            break;
                    }
                }

                if(document.querySelector('input[name="city"]')) document.querySelector('input[name="city"]').value = city;
                if(document.querySelector('input[name="province"]')) document.querySelector('input[name="province"]').value = state;
                if(document.querySelector('input[name="country"]')) document.querySelector('input[name="country"]').value = country;
                if(document.querySelector('input[name="postal_code"]')) document.querySelector('input[name="postal_code"]').value = postal_code;
            });
        }

        // --- Face Verification ---
        const video = document.getElementById('video');
        const startBtn = document.getElementById('start-verification-btn');
        const statusDiv = document.getElementById('verification-status');
        
        if (startBtn) {
            startBtn.addEventListener('click', async () => {
                startBtn.disabled = true;
                statusDiv.style.display = 'block';
                statusDiv.innerText = 'Loading models...';

                try {
                    await Promise.all([
                        faceapi.nets.tinyFaceDetector.loadFromUri('https://justadudewhohacks.github.io/face-api.js/models'),
                        faceapi.nets.faceLandmark68Net.loadFromUri('https://justadudewhohacks.github.io/face-api.js/models'),
                        faceapi.nets.faceRecognitionNet.loadFromUri('https://justadudewhohacks.github.io/face-api.js/models'),
                        faceapi.nets.ssdMobilenetv1.loadFromUri('https://justadudewhohacks.github.io/face-api.js/models')
                    ]);

                    statusDiv.innerText = 'Starting camera...';
                    startVideo();
                } catch (err) {
                    console.error(err);
                    statusDiv.innerText = 'Error loading models. Please reload and try again.';
                    statusDiv.className = 'alert alert-danger';
                }
            });
        }

        function startVideo() {
            navigator.mediaDevices.getUserMedia({ video: {} })
                .then(stream => {
                    video.srcObject = stream;
                    statusDiv.innerText = 'Detecting face... Please look at the camera.';
                })
                .catch(err => {
                    console.error(err);
                    statusDiv.innerText = 'Unable to access camera.';
                    statusDiv.className = 'alert alert-danger';
                });
        }

        if (video) {
            video.addEventListener('play', () => {
                const canvas = document.getElementById('overlay');
                const displaySize = { width: video.width, height: video.height };
                faceapi.matchDimensions(canvas, displaySize);

                setInterval(async () => {
                    const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceDescriptors();
                    const resizedDetections = faceapi.resizeResults(detections, displaySize);
                    canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
                    faceapi.draw.drawDetections(canvas, resizedDetections);

                    if (detections.length > 0) {
                        statusDiv.className = 'alert alert-success';
                        statusDiv.innerText = 'Face detected! Verifying...';

                        setTimeout(() => {
                            verifyFace(detections[0].descriptor);
                        }, 2000);
                    }
                }, 100);
            });
        }

        async function verifyFace(descriptor) {
            try {
                const response = await fetch('{{ route("vendor.face.verification", $vendor->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({})
                });

                const result = await response.json();

                if (result.success) {
                    statusDiv.innerText = result.message;
                    setTimeout(() => {
                        window.location.href = '{{ route("vendor.home") }}';
                    }, 1500);
                } else {
                    statusDiv.className = 'alert alert-danger';
                    statusDiv.innerText = result.message;
                }
            } catch (error) {
                console.error(error);
                statusDiv.className = 'alert alert-danger';
                statusDiv.innerText = 'Verification failed. Please try again.';
            }
        }
    </script>
@endpush