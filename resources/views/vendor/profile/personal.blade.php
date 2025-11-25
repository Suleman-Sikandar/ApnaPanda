<div class="content-section">
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

@push('scripts')
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
</script>
@endpush
