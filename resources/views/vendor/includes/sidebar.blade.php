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
            @php
                $status = $vendor->status; // pending, approved, suspended, rejected

                switch ($status) {
                    case 'approved':
                        $badge = [
                            'color' => '#10b981',
                            'icon' => 'fas fa-check-circle',
                            'text' => 'Approved',
                        ];
                        break;

                    case 'pending':
                        $badge = [
                            'color' => '#f59e0b',
                            'icon' => 'fas fa-clock',
                            'text' => 'Pending',
                        ];
                        break;

                    case 'suspended':
                        $badge = [
                            'color' => '#ef4444',
                            'icon' => 'fas fa-ban',
                            'text' => 'Suspended',
                        ];
                        break;

                    case 'rejected':
                        $badge = [
                            'color' => '#6b7280',
                            'icon' => 'fas fa-times-circle',
                            'text' => 'Rejected',
                        ];
                        break;

                    default:
                        $badge = [
                            'color' => '#6b7280',
                            'icon' => 'fas fa-question-circle',
                            'text' => 'Unknown',
                        ];
                        break;
                }
            @endphp

            <span
                style="background: {{ $badge['color'] }}; color: white; padding: 5px 15px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                <i class="{{ $badge['icon'] }}"></i> {{ $badge['text'] }}
            </span>

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
        @php
            $allStepsComplete = $vendor->current_step >= 7;
        @endphp

        <a href="{{ route('vendor.profile', $vendor->id) }}"
            class="menu-item {{ $activeSection == 'profile' ? 'active' : '' }}">
            <i class="fas fa-user"></i>
            <span>Personal Info</span>
        </a>

        <a href="{{ $vendor->current_step >= 2 || $allStepsComplete ? route('vendor.business.info', $vendor->id) : '#' }}"
            class="menu-item {{ $activeSection == 'business' ? 'active' : '' }} {{ $vendor->current_step < 2 && !$allStepsComplete ? 'disabled' : '' }}"
            style="{{ $vendor->current_step < 2 && !$allStepsComplete ? 'opacity: 0.5; cursor: not-allowed;' : '' }}">
            <i class="fas fa-building"></i>
            <span>Business Info</span>
            @if ($vendor->current_step < 2 && !$allStepsComplete)
                <i class="fas fa-lock" style="float: right; margin-top: 4px; font-size: 12px;"></i>
            @endif
        </a>

        <a href="{{ $vendor->current_step >= 3 || $allStepsComplete ? route('vendor.documents', $vendor->id) : '#' }}"
            class="menu-item {{ $activeSection == 'documents' ? 'active' : '' }} {{ $vendor->current_step < 3 && !$allStepsComplete ? 'disabled' : '' }}"
            style="{{ $vendor->current_step < 3 && !$allStepsComplete ? 'opacity: 0.5; cursor: not-allowed;' : '' }}">
            <i class="fas fa-file-alt"></i>
            <span>Documents</span>
            @if ($vendor->current_step < 3 && !$allStepsComplete)
                <i class="fas fa-lock" style="float: right; margin-top: 4px; font-size: 12px;"></i>
            @endif
        </a>

        <a href="{{ $vendor->current_step >= 4 || $allStepsComplete ? route('vendor.bank', $vendor->id) : '#' }}"
            class="menu-item {{ $activeSection == 'bank' ? 'active' : '' }} {{ $vendor->current_step < 4 && !$allStepsComplete ? 'disabled' : '' }}"
            style="{{ $vendor->current_step < 4 && !$allStepsComplete ? 'opacity: 0.5; cursor: not-allowed;' : '' }}">
            <i class="fas fa-university"></i>
            <span>Bank Details</span>
            @if ($vendor->current_step < 4 && !$allStepsComplete)
                <i class="fas fa-lock" style="float: right; margin-top: 4px; font-size: 12px;"></i>
            @endif
        </a>

        <a href="{{ $vendor->current_step >= 5 || $allStepsComplete ? route('vendor.address', $vendor->id) : '#' }}"
            class="menu-item {{ $activeSection == 'addresses' ? 'active' : '' }} {{ $vendor->current_step < 5 && !$allStepsComplete ? 'disabled' : '' }}"
            style="{{ $vendor->current_step < 5 && !$allStepsComplete ? 'opacity: 0.5; cursor: not-allowed;' : '' }}">
            <i class="fas fa-map-marker-alt"></i>
            <span>Address</span>
            @if ($vendor->current_step < 5 && !$allStepsComplete)
                <i class="fas fa-lock" style="float: right; margin-top: 4px; font-size: 12px;"></i>
            @endif
        </a>

        <a href="{{ $vendor->current_step >= 6 || $allStepsComplete ? route('vendor.face.verification', $vendor->id) : '#' }}"
            class="menu-item {{ $activeSection == 'face_verification' ? 'active' : '' }} {{ $vendor->current_step < 6 && !$allStepsComplete ? 'disabled' : '' }}"
            style="{{ $vendor->current_step < 6 && !$allStepsComplete ? 'opacity: 0.5; cursor: not-allowed;' : '' }}">
            <i class="fas fa-camera"></i>
            <span>Face Verification</span>
            @if ($vendor->current_step < 6 && !$allStepsComplete)
                <i class="fas fa-lock" style="float: right; margin-top: 4px; font-size: 12px;"></i>
            @endif
        </a>

        <a href="{{ route('vendor.security', $vendor->id) }}"
            class="menu-item {{ $activeSection == 'security' ? 'active' : '' }}">
            <i class="fas fa-shield-alt"></i>
            <span>Security</span>
        </a>
    </nav>
</aside>

@push('scripts')
    <script>
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
    </script>
@endpush
