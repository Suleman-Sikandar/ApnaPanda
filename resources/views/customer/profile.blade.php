@extends('customer.master')

@section('title', 'My Profile | ApnaPanda')

@section('topBar')
    @include('customer.includes.topBar')
@endsection
@section('navBar')
    @include('customer.includes.navBar')
@endsection
@section('categories')
    @include('customer.includes.category')
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
                            style="background-size: cover; background-position: center; width:120px; height:120px; border-radius:50%; cursor:pointer; background-image: url('{{ $users->profile_image ? asset('storage/' . $users->profile_image) : asset('/mnt/data/c083e360-8194-46ab-b166-ad3e59d4dea8.png') }}');"
                            title="View Profile Photo"
                            onclick="openImageModal('{{ $users->profile_image ? asset('storage/' . $users->profile_image) : asset('/mnt/data/c083e360-8194-46ab-b166-ad3e59d4dea8.png') }}')">
                        </div>

                        <!-- Modal -->
                        <div id="imageModal"
                            style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); justify-content:center; align-items:center; z-index:9999;">
                            <img id="modalImage" src=""
                                style="max-width:400px; max-height:400px; border-radius:50%; box-shadow:0 0 15px rgba(0,0,0,0.5);">
                        </div>

                        <div class="profile-name">{{ $users->name }}</div>
                        <div class="profile-email">{{ $users->email }}</div>
                        <div class="profile-stats">
                            <div class="stat-item">
                                <div class="stat-value">48</div>
                                <div class="stat-label">Orders</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">4.8</div>
                                <div class="stat-label">Rating</div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu -->
                    <div class="sidebar-menu">
                        <a href="#" class="menu-item active" onclick="showSection('profile'); return false;">
                            <i class="fas fa-user"></i>
                            <span>Profile Info</span>
                        </a>
                        <a href="#" class="menu-item" onclick="showSection('addresses'); return false;">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>My Addresses</span>
                        </a>
                        <a href="#" class="menu-item" onclick="showSection('payment'); return false;">
                            <i class="fas fa-credit-card"></i>
                            <span>Payment Methods</span>
                        </a>
                        <a href="#" class="menu-item" onclick="showSection('security'); return false;">
                            <i class="fas fa-shield-alt"></i>
                            <span>Security</span>
                        </a>
                        <a href="{{ url('/orders') }}" class="menu-item">
                            <i class="fas fa-shopping-bag"></i>
                            <span>My Orders</span>
                        </a>
                        <a href="#" class="menu-item" onclick="showSection('favorites'); return false;">
                            <i class="fas fa-heart"></i>
                            <span>Favorites</span>
                        </a>
                        <a href="#" class="menu-item" onclick="showSection('wallet'); return false;">
                            <i class="fas fa-wallet"></i>
                            <span>My Wallet</span>
                        </a>
                        <a href="#" class="menu-item">
                            <i class="fas fa-headset"></i>
                            <span>Help & Support</span>
                        </a>
                    </div>
                </aside>

                <!-- Main Content -->
                <div class="profile-content">
                    <!-- Profile Info Section -->
                    <div id="profile-section" class="content-section">
                        <div class="section-header">
                            <h2 class="section-title">Personal Information</h2>
                        </div>
                        <form id="profile-form" action="{{ url('profile/' . $users->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-grid">

                                <!-- Name -->
                                <div class="form-group">
                                    <label class="form-label">First Name <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name', $users->name) }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email', $users->email) }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div class="form-group">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ old('phone', $users->phone ?? '') }}">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Date of Birth -->
                                <div class="form-group">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                        name="date_of_birth"
                                        value="{{ old('date_of_birth', $users->date_of_birth ? \Carbon\Carbon::parse($users->date_of_birth)->format('Y-m-d') : '') }}">
                                    @error('date_of_birth')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Gender -->
                                <div class="form-group">
                                    <label class="form-label">Gender</label>
                                    <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                        <option value="Male"
                                            {{ old('gender', $users->gender) == 'Male' ? 'selected' : '' }}>
                                            Male</option>
                                        <option value="Female"
                                            {{ old('gender', $users->gender) == 'Female' ? 'selected' : '' }}>Female
                                        </option>
                                        <option value="Other"
                                            {{ old('gender', $users->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Profile Image -->
                                <div class="form-group">
                                    <label class="form-label">Profile Image</label>
                                    <input type="file" id="profileImageInput" name="profile_image" accept="image/*"
                                        style="display:none;">
                                    <button type="button" id="openImagePicker" class="btn btn-primary">Upload
                                        Image</button>
                                    @error('profile_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    <!-- Cropping Preview -->
                                    <div id="cropContainer" style="display:none; margin-top: 15px;">
                                        <h5>Adjust Your Image</h5>
                                        <img id="cropperImage" style="max-width:100%; border-radius:10px;">
                                        <div style="margin-top:10px;">
                                            <button type="button" id="cropImageBtn"
                                                class="btn btn-success">Save</button>
                                            <button type="button" id="cancelCropBtn"
                                                class="btn btn-danger">Cancel</button>
                                        </div>
                                    </div>

                                    <!-- Final Preview -->
                                    <img id="profilePreviewForm"
                                        src="{{ asset('storage/' . $users->profile_image ?? '') }}"
                                        style="width:120px; height:120px; border-radius:10px; margin-top:10px; display:block;">
                                </div>

                            </div>
                            <button type="submit" class="save-btn">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('customer.includes.footer')
@endsection
@push('scripts')
    <script>
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

            // Update sidebar
            document.getElementById('profileSidebarAvatar').style.backgroundImage = `url(${croppedImg})`;

            // OPTIONAL: Save cropped image to the hidden input for upload
            const imgInput = document.createElement("input");
            imgInput.type = "hidden";
            imgInput.name = "croppedImage";
            imgInput.value = croppedImg;
            document.querySelector("form").appendChild(imgInput);

            document.getElementById('cropContainer').style.display = 'none';

            cropper.destroy();
        };
    </script>
    <script>
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
    </script>
@endpush
