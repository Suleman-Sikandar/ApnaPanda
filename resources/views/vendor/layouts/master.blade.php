<!DOCTYPE html>
<html lang="en">
@include('vendor.includes.head')

<body>
    @include('vendor.includes.nav')
    
    <main class="main-content">
        @yield('content')
    </main>
    
    @include('vendor.includes.footer')
    @include('vendor.includes.scripts')
    @stack('scripts')
</body>

</html>
