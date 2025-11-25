<!DOCTYPE html>
<html lang="en">
@include('customer.includes.head')

<body>
    @yield('topBar')
    @yield('navBar')
    @yield('vendorNav')
    @yield('categories')
    <main class="main-content">
        @yield('content')
    </main>
    @yield('footer')
    @include('customer.includes.script')
    @stack('scripts')
</body>

</html>
