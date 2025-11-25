<div class="content-section">
    <div class="section-header">
        <h2 class="section-title">Document Uploads</h2>
        <p style="color: #6b7280; font-size: 14px;">Upload required documents for verification</p>
    </div>
    <form action="{{ url('vendor/documents/' . $vendor->id) }}" method="POST" enctype="multipart/form-data">
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
