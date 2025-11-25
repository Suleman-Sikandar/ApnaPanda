<div class="content-section">
    <div class="section-header">
        <h2 class="section-title">Bank Details</h2>
        <p style="color: #6b7280; font-size: 14px;">Add your bank account information</p>
    </div>
    <form action="{{ url('vendor/bank/' . $vendor->id) }}" method="POST">
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
