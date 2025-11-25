<div class="content-section">
    <div class="section-header">
        <h2 class="section-title">Business Information</h2>
        <p style="color: #6b7280; font-size: 14px;">Tell us about your business</p>
    </div>
    <form action="{{ url('vendor/business-profile/business-information/' . $vendor->id) }}" method="POST" enctype="multipart/form-data">
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
