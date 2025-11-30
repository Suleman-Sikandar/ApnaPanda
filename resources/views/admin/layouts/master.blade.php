<!DOCTYPE html>
<html lang="en">
@include('admin.includes.head')
<body>
    @yield('sidebar')
    <div class="main-content">
        @yield('header')
        @yield('content')
        @yield('footer')
    </div>
    
    @include('admin.includes.scripts')
    @stack('scripts')
</body>
</html>
