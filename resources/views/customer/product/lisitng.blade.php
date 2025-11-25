@extends('customer.master')

@section('title', 'Burger King - Menu | ApnaPanda')

@section('navBar')
    @include('customer.includes.navBar')
@endsection
@section('categories')
    @include('customer.includes.category')
@endsection


@section('content')
<!-- Vendor Header -->
<div class="vendor-header">
    <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=1200" alt="Restaurant Cover" class="vendor-cover">
    <div class="vendor-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="vendor-title">Burger King</h1>
                    <div class="vendor-info-bar">
                        <div class="info-item">
                            <span class="rating-large">
                                <i class="fas fa-star"></i> 4.5
                            </span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-clock"></i>
                            <span>25-30 mins</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-rupee-sign"></i>
                            <span>Rs.150 for two</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Clifton Block 2, Karachi</span>
                        </div>
                    </div>
                    <div class="vendor-tags-large">
                        <span class="tag-large">🍔 Burgers</span>
                        <span class="tag-large">🍟 Fast Food</span>
                        <span class="tag-large">🥤 Beverages</span>
                    </div>
                    <div class="offer-banner">
                        <i class="fas fa-tag"></i> 30% OFF on orders above Rs.500 | Use code: BURGER30
                    </div>
                </div>
                <div class="col-lg-4 text-end">
                    <div class="mt-4">
                        <button class="btn btn-outline-danger me-2">
                            <i class="far fa-heart"></i> Save
                        </button>
                        <button class="btn btn-outline-secondary">
                            <i class="fas fa-share-alt"></i> Share
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Menu Container -->
<div class="container">
    <div class="menu-container">
        <!-- Sidebar Categories -->
        <aside class="menu-sidebar">
            <h5>Menu Categories</h5>
            <a href="#burgers" class="menu-category-link active">Burgers (12)</a>
            <a href="#combo" class="menu-category-link">Combo Meals (8)</a>
            <a href="#sides" class="menu-category-link">Sides (6)</a>
            <a href="#beverages" class="menu-category-link">Beverages (10)</a>
            <a href="#desserts" class="menu-category-link">Desserts (5)</a>
        </aside>

        <!-- Menu Content -->
        <div class="menu-content">
            <!-- Search & Filter -->
            <div class="menu-search">
                <input type="text" placeholder="Search for dishes...">
                <div class="filter-chips">
                    <div class="filter-chip active">All Items</div>
                    <div class="filter-chip">🌱 Veg Only</div>
                    <div class="filter-chip">⭐ Bestsellers</div>
                    <div class="filter-chip">🔥 Spicy</div>
                </div>
            </div>

            <!-- Burgers Category -->
            <div id="burgers" class="category-section">
                <h2 class="category-header">Burgers</h2>

                <!-- Product 1 -->
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=300" alt="Whopper" class="product-image">
                    <div class="product-info">
                        <div class="product-badges">
                            <span class="badge-bestseller">⭐ Bestseller</span>
                        </div>
                        <h3 class="product-name">Whopper</h3>
                        <p class="product-description">Flame-grilled beef patty with fresh vegetables, pickles, and signature sauce on a sesame seed bun</p>
                        <div class="product-price">Rs. 450</div>
                        <button class="add-to-cart-btn" onclick="addToCart(1)">
                            <i class="fas fa-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1550547660-d9450f859349?w=300" alt="Chicken Burger" class="product-image">
                    <div class="product-info">
                        <div class="product-badges">
                            <span class="badge-spicy">🌶️ Spicy</span>
                        </div>
                        <h3 class="product-name">Crispy Chicken Burger</h3>
                        <p class="product-description">Crispy fried chicken breast with lettuce, mayo, and our special spicy sauce</p>
                        <div class="product-price">Rs. 380</div>
                        <button class="add-to-cart-btn" onclick="addToCart(2)">
                            <i class="fas fa-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1553979459-d2229ba7433b?w=300" alt="Cheese Burger" class="product-image">
                    <div class="product-info">
                        <div class="product-badges">
                            <span class="badge-bestseller">⭐ Bestseller</span>
                        </div>
                        <h3 class="product-name">Double Cheese Burger</h3>
                        <p class="product-description">Two beef patties with double cheese, lettuce, tomatoes, and special sauce</p>
                        <div class="product-price">Rs. 520</div>
                        <button class="add-to-cart-btn" onclick="addToCart(3)">
                            <i class="fas fa-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1520072959219-c595dc870360?w=300" alt="Veggie Burger" class="product-image">
                    <div class="product-info">
                        <div class="product-badges">
                            <span class="badge-veg">🌱 VEG</span>
                        </div>
                        <h3 class="product-name">Veggie Delight Burger</h3>
                        <p class="product-description">Crispy vegetable patty with fresh salad and tangy sauce</p>
                        <div class="product-price">Rs. 320</div>
                        <button class="add-to-cart-btn" onclick="addToCart(4)">
                            <i class="fas fa-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>

            <!-- Combo Meals Category -->
            <div id="combo" class="category-section">
                <h2 class="category-header">Combo Meals</h2>

                <!-- Combo 1 -->
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1571091655789-405eb7a3a3a8?w=300" alt="King Combo" class="product-image">
                    <div class="product-info">
                        <div class="product-badges">
                            <span class="badge-bestseller">⭐ Bestseller</span>
                        </div>
                        <h3 class="product-name">King Combo</h3>
                        <p class="product-description">Whopper + Large Fries + Large Drink + 4 Pc Nuggets</p>
                        <div class="product-price">Rs. 850</div>
                        <button class="add-to-cart-btn" onclick="addToCart(5)">
                            <i class="fas fa-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>

                <!-- Combo 2 -->
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1561758033-d89a9ad46330?w=300" alt="Chicken Combo" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Crispy Chicken Combo</h3>
                        <p class="product-description">Crispy Chicken Burger + Medium Fries + Medium Drink</p>
                        <div class="product-price">Rs. 650</div>
                        <button class="add-to-cart-btn" onclick="addToCart(6)">
                            <i class="fas fa-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sides Category -->
            <div id="sides" class="category-section">
                <h2 class="category-header">Sides</h2>

                <!-- Side 1 -->
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=300" alt="Fries" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">French Fries</h3>
                        <p class="product-description">Crispy golden fries seasoned to perfection</p>
                        <div class="product-price">Rs. 120</div>
                        <button class="add-to-cart-btn" onclick="addToCart(7)">
                            <i class="fas fa-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>

                <!-- Side 2 -->
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1562967914-608f82629710?w=300" alt="Onion Rings" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Onion Rings</h3>
                        <p class="product-description">Crispy battered onion rings with dipping sauce</p>
                        <div class="product-price">Rs. 180</div>
                        <button class="add-to-cart-btn" onclick="addToCart(8)">
                            <i class="fas fa-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>

            <!-- Beverages Category -->
            <div id="beverages" class="category-section">
                <h2 class="category-header">Beverages</h2>

                <!-- Beverage 1 -->
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1554866585-cd94860890b7?w=300" alt="Soft Drink" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Soft Drink</h3>
                        <p class="product-description">Chilled soft drink (Coke/Pepsi/Sprite)</p>
                        <div class="product-price">Rs. 80</div>
                        <button class="add-to-cart-btn" onclick="addToCart(9)">
                            <i class="fas fa-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>

                <!-- Beverage 2 -->
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1622597468858-0eaa0bec5cd5?w=300" alt="Shake" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Chocolate Shake</h3>
                        <p class="product-description">Thick and creamy chocolate milkshake</p>
                        <div class="product-price">Rs. 250</div>
                        <button class="add-to-cart-btn" onclick="addToCart(10)">
                            <i class="fas fa-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>

            <!-- Desserts Category -->
            <div id="desserts" class="category-section">
                <h2 class="category-header">Desserts</h2>

                <!-- Dessert 1 -->
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=300" alt="Ice Cream" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Vanilla Ice Cream</h3>
                        <p class="product-description">Creamy vanilla soft serve ice cream</p>
                        <div class="product-price">Rs. 150</div>
                        <button class="add-to-cart-btn" onclick="addToCart(11)">
                            <i class="fas fa-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>

                <!-- Dessert 2 -->
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=300" alt="Brownie" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Chocolate Brownie</h3>
                        <p class="product-description">Warm chocolate brownie with chocolate chips</p>
                        <div class="product-price">Rs. 180</div>
                        <button class="add-to-cart-btn" onclick="addToCart(12)">
                            <i class="fas fa-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Cart Button -->
<div class="cart-float" onclick="location.href='{{ url('/cart') }}'">
    <div class="cart-float-count">3</div>
    <span>View Cart</span>
    <span style="font-size: 1.2rem;">Rs. 950</span>
</div>
@endsection

@section('footer')
    @include('customer.includes.footer')
@endsection
@section('scripts')
<script>
    // Add to cart functionality
    function addToCart(productId) {
        console.log('Adding product to cart:', productId);
        // Add your cart logic here
        alert('Product added to cart!');
    }

    // Smooth scroll for category links
    document.querySelectorAll('.menu-category-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('.menu-category-link').forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            
            const target = document.querySelector(this.getAttribute('href'));
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

    // Search functionality
    document.querySelector('.menu-search input').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        console.log('Searching for:', searchTerm);
        // Add your search logic here
    });

    // Filter chips
    document.querySelectorAll('.filter-chip').forEach(chip => {
        chip.addEventListener('click', function() {
            document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            console.log('Filter selected:', this.textContent);
            // Add your filter logic here
        });
    });
</script>
@endsection