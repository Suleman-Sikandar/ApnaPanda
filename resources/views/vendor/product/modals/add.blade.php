<!-- Drawer Overlay -->
<div class="drawer-overlay" id="ProductDrawerModal">

    <!-- Drawer Modal -->
    <div class="drawer" id="ProductDrawerBox">

        <!-- Header -->
        <div class="drawer-header">
            <h2 class="drawer-title">Add New Product</h2>
            <span class="drawer-close">&times;</span>
        </div>

        <!-- Body -->
        <div class="drawer-body">
            <form class="drawer-form" id="productForm" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Product Name -->
                <div class="drawer-form-group">
                    <label>Product Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" placeholder="Enter product name" required>
                    <span class="form-error text-danger" id="error-name"></span>
                </div>

                <!-- Category -->
                <div class="drawer-form-group">
                    <label>Category <span class="text-danger">*</span></label>
                    <select name="category_id" required>
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                    <span class="form-error text-danger" id="error-category_id"></span>
                </div>

                <!-- Price -->
                <div class="drawer-form-group">
                    <label>Price <span class="text-danger">*</span></label>
                    <input type="number" name="price" placeholder="Enter product price" step="0.01" required>
                    <span class="form-error text-danger" id="error-price"></span>
                </div>

                <!-- Stock Quantity -->
                <div class="drawer-form-group">
                    <label>Stock Quantity</label>
                    <input type="number" name="stock_quantity" min="0" value="0">
                    <span class="form-error text-danger" id="error-stock_quantity"></span>
                </div>

                <!-- SKU -->
                <div class="drawer-form-group">
                    <label>SKU</label>
                    <input type="text" name="SKU" placeholder="Enter product SKU">
                    <span class="form-error text-danger" id="error-SKU"></span>
                </div>

                <!-- Rating -->
                <div class="drawer-form-group">
                    <label>Rating (0-5)</label>
                    <input type="number" name="rating" step="0.1" min="0" max="5" value="0">
                    <span class="form-error text-danger" id="error-rating"></span>
                </div>

                <!-- Review Count -->
                <div class="drawer-form-group">
                    <label>Review Count</label>
                    <input type="number" name="review_count" min="0" value="0">
                    <span class="form-error text-danger" id="error-review_count"></span>
                </div>

                <!-- Discount Percent -->
                <div class="drawer-form-group">
                    <label>Discount Percentage (%)</label>
                    <input type="number" name="discount_percent" step="0.01" min="0" max="100" value="0">
                    <span class="form-error text-danger" id="error-discount_percent"></span>
                </div>

                <!-- Free Delivery -->
                <div class="drawer-form-group">
                    <label>Free Delivery</label>
                    <select name="has_free_delivery">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                    <span class="form-error text-danger" id="error-has_free_delivery"></span>
                </div>

                <!-- Delivery Charge -->
                <div class="drawer-form-group">
                    <label>Delivery Charge (PKR)</label>
                    <input type="number" name="delivery_charge" step="0.01" min="0" value="0">
                    <span class="form-error text-danger" id="error-delivery_charge"></span>
                </div>

                <!-- Product Images -->
                <div class="drawer-form-group">
                    <label>Product Images</label>
                    <div class="image-wrapper">
                        <div class="image-input-group mb-2 d-flex gap-2">
                            <input type="file" name="images[]" accept="image/*" class="form-control">
                            <button type="button" class="btn btn-success add-image-btn">+</button>
                        </div>
                    </div>
                    <span class="form-error text-danger" id="error-images"></span>
                </div>

            </form>
        </div>

        <!-- Footer -->
        <div class="drawer-footer">
            <button type="button" class="btn-cancel" onclick="closeProductAddDrawer()">Cancel</button>
            <button type="submit" class="btn-submit" form="productForm">Save</button>
        </div>

    </div>
</div>
