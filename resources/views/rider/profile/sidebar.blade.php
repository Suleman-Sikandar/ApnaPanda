<aside class="profile-sidebar">
    <div class="profile-card">
        <div class="profile-avatar" id="profileSidebarAvatar"
            style="background-size: cover; background-position: center; width:120px; height:120px; border-radius:50%; cursor:pointer; background-image: url('{{ $rider->profile_image ? asset('storage/' . $rider->profile_image) : asset('/images/placeholders/shops.png') }}');"
            title="View Profile Photo">
        </div>

        <div style="text-align: center; margin-top: 10px;">
            @php
                $status = $rider->status ?? 'pending';
                switch ($status) {
                    case 'approved':
                        $badge = ['color' => '#10b981', 'icon' => 'fas fa-check-circle', 'text' => 'Approved'];
                        break;
                    case 'pending':
                        $badge = ['color' => '#f59e0b', 'icon' => 'fas fa-clock', 'text' => 'Pending'];
                        break;
                    case 'suspended':
                        $badge = ['color' => '#ef4444', 'icon' => 'fas fa-ban', 'text' => 'Suspended'];
                        break;
                    case 'rejected':
                        $badge = ['color' => '#6b7280', 'icon' => 'fas fa-times-circle', 'text' => 'Rejected'];
                        break;
                    default:
                        $badge = ['color' => '#6b7280', 'icon' => 'fas fa-question-circle', 'text' => 'Unknown'];
                        break;
                }
            @endphp

            <span style="background: {{ $badge['color'] }}; color: white; padding: 5px 15px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                <i class="{{ $badge['icon'] }}"></i> {{ $badge['text'] }}
            </span>
        </div>

        <div class="profile-name">{{ $rider->name }}</div>
        <div class="profile-email">{{ $rider->email }}</div>
    </div>

    @php
        $allStepsComplete = $rider->current_step >= 6;
    @endphp

    <nav class="profile-menu">
        <a href="{{ route('rider.profile', $rider->id) }}"
            class="menu-item {{ $activeSection == 'profile' ? 'active' : '' }}">
            <i class="fas fa-user"></i>
            <span>Personal Info</span>
        </a>

        <a href="{{ $rider->current_step >= 2 || $allStepsComplete ? route('rider.vehicle', $rider->id) : '#' }}"
            class="menu-item {{ $activeSection == 'vehicle' ? 'active' : '' }} {{ $rider->current_step < 2 && !$allStepsComplete ? 'disabled' : '' }}"
            style="{{ $rider->current_step < 2 && !$allStepsComplete ? 'opacity: 0.5; cursor: not-allowed;' : '' }}">
            <i class="fas fa-motorcycle"></i>
            <span>Vehicle Info</span>
            @if ($rider->current_step < 2 && !$allStepsComplete)
                <i class="fas fa-lock" style="float: right; margin-top: 4px; font-size: 12px;"></i>
            @endif
        </a>

        <a href="{{ $rider->current_step >= 3 || $allStepsComplete ? route('rider.documents', $rider->id) : '#' }}"
            class="menu-item {{ $activeSection == 'documents' ? 'active' : '' }} {{ $rider->current_step < 3 && !$allStepsComplete ? 'disabled' : '' }}"
            style="{{ $rider->current_step < 3 && !$allStepsComplete ? 'opacity: 0.5; cursor: not-allowed;' : '' }}">
            <i class="fas fa-file-alt"></i>
            <span>Documents</span>
            @if ($rider->current_step < 3 && !$allStepsComplete)
                <i class="fas fa-lock" style="float: right; margin-top: 4px; font-size: 12px;"></i>
            @endif
        </a>

        <a href="{{ $rider->current_step >= 4 || $allStepsComplete ? route('rider.address', $rider->id) : '#' }}"
            class="menu-item {{ $activeSection == 'address' ? 'active' : '' }} {{ $rider->current_step < 4 && !$allStepsComplete ? 'disabled' : '' }}"
            style="{{ $rider->current_step < 4 && !$allStepsComplete ? 'opacity: 0.5; cursor: not-allowed;' : '' }}">
            <i class="fas fa-map-marker-alt"></i>
            <span>Address</span>
            @if ($rider->current_step < 4 && !$allStepsComplete)
                <i class="fas fa-lock" style="float: right; margin-top: 4px; font-size: 12px;"></i>
            @endif
        </a>

        <a href="{{ $rider->current_step >= 5 || $allStepsComplete ? route('rider.face.verification', $rider->id) : '#' }}"
            class="menu-item {{ $activeSection == 'face_verification' ? 'active' : '' }} {{ $rider->current_step < 5 && !$allStepsComplete ? 'disabled' : '' }}"
            style="{{ $rider->current_step < 5 && !$allStepsComplete ? 'opacity: 0.5; cursor: not-allowed;' : '' }}">
            <i class="fas fa-camera"></i>
            <span>Face Verification</span>
            @if ($rider->current_step < 5 && !$allStepsComplete)
                <i class="fas fa-lock" style="float: right; margin-top: 4px; font-size: 12px;"></i>
            @endif
        </a>

        <a href="{{ route('rider.security', $rider->id) }}"
            class="menu-item {{ $activeSection == 'security' ? 'active' : '' }}">
            <i class="fas fa-shield-alt"></i>
            <span>Security</span>
        </a>
    </nav>
</aside>

