<!DOCTYPE html>
<html lang="en">
@include('rider.include.head')
<body>
   @yield('sidebar')

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
       @yield('navbar')

        <!-- Page Content -->
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
    </div>

    @include('rider.include.script')
    @yield('scripts')
</body>
</html>