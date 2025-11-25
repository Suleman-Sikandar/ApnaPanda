<!-- Top Bar -->
<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <i class="fas fa-map-marker-alt"></i> Deliver to: <strong>Karachi, Pakistan</strong>
            </div>
            <div class="col-md-6 text-end">
                <a href="#">
                    <i class="fas fa-headset"></i> Customer Support
                </a>

                @auth
                    <a href="{{ url('vendor/business-profile/' . Auth::id()) }}">
                        <i class="fas fa-store"></i> Become a Vendor
                    </a>
                @endauth

                @guest
                    <a href="{{ route('login') }}">
                        <i class="fas fa-store"></i> Become a Vendor
                    </a>
                @endguest

                <a href="#">
                    <i class="fas fa-motorcycle"></i> Become a Rider
                </a>
            </div>
        </div>
    </div>
</div>
