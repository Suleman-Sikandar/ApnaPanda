<!DOCTYPE html>
<html lang="en">
@include('vendor.include.head')
<body>
   @yield('sidebar')
    <div class="main-content">
       @yield('header')
        @yield('content')
    </div>
    @include('vendor.include.script')
    @stack('scripts')
</body>
</html>