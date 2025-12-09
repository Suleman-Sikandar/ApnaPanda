  <!-- Category Navigation -->
    <div class="category-nav" style="padding-top: 30px;">
        <div class="container">
            <nav class="nav justify-content-center">
                <a class="nav-link {{ !request()->category ? 'active' : '' }}" href="{{ url('/') }}">
                    <i class="fas fa-home"></i> All
                </a>
                @foreach($categories as $category)
                <a class="nav-link {{ request()->category == $category->id ? 'active' : '' }}" 
                   href="{{ url('/?category=' . $category->id) }}">
                    <i class="{{ $category->icon_class }}"></i> {{ $category->category_name }}
                </a>
                @endforeach
                 <a class="nav-link" href="{{ url('/') }}">
                    <i class="fas fa-box"></i> Parcel
                </a>
            </nav>
        </div>
    </div>