<!DOCTYPE html>
<html lang="en">
@include('vendor.includes.head')
@push('styles')
<style>
    .top-nav {
        background: white;
        padding: 15px 30px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 10;
    }
    .toggle-btn {
        background: none;
        border: none;
        font-size: 20px;
        color: #333;
    }
    .user-info {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .status-toggle {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        color: #374151;
    }
    .status-badge {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 12px;
        color: #fff;
    }
    .status-badge.online { background: #16a34a; }
    .status-badge.offline { background: #f97316; }
    .profile-layout {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 24px;
        margin-top: 20px;
    }
    .profile-sidebar {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        padding: 20px;
        position: sticky;
        top: 90px;
        height: fit-content;
    }
    .profile-content {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        padding: 20px;
    }
    @media (max-width: 992px) {
        .profile-layout { grid-template-columns: 1fr; }
        .profile-sidebar { position: static; }
    }
</style>
@endpush
<body>
    <main class="main-content">
        @include('rider.include.navbar')

        <div class="container-fluid p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>
    
    @include('vendor.includes.footer')
    @include('vendor.includes.scripts')
    @stack('scripts')
</body>

</html>