<!-- Drawer Overlay -->
<div class="drawer-overlay" id="ProductDrawerModal">

    <!-- Drawer Modal -->
    <div class="drawer" id="ProductDrawerBox">

        <!-- Header -->
        <div class="drawer-header">
            <h2 class="drawer-title" id="drawerTitle">Add New Product</h2>
            <span class="drawer-close">&times;</span>
        </div>

        <!-- Body -->
        <div class="drawer-body">
            <form class="drawer-form" id="productForm" method="POST">
                @csrf

                <!-- Product Name -->
                <div class="drawer-form-group">
                    <label for="name">Product Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Enter product name" required>
                    <span class="form-error text-danger" id="error-name"></span>
                </div>

                <!-- Vendor -->
                <div class="drawer-form-group">
                    <label for="vendor_id">Vendor <span class="text-danger">*</span></label>
                    <select name="vendor_id" id="vendor_id" required>
                        <option value="">-- Select Vendor --</option>
                        @foreach ($vendors as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->users->name }}</option>
                        @endforeach
                    </select>
                    <span class="form-error text-danger" id="error-vendor_id"></span>
                </div>

                <!-- Category -->
                <div class="drawer-form-group">
                    <label for="category_id">Category <span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" required>
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                    <span class="form-error text-danger" id="error-category_id"></span>
                </div>

                <!-- Price -->
                <div class="drawer-form-group">
                    <label for="price">Price <span class="text-danger">*</span></label>
                    <input type="number" name="price" id="price" placeholder="Enter Product Price" step="0.01" required>
                    <span class="form-error text-danger" id="error-price"></span>
                </div>

                <!-- Stock Quantity -->
                <div class="drawer-form-group">
                    <label for="stock_quantity">Stock Quantity</label>
                    <input type="number" name="stock_quantity" id="stock_quantity" placeholder="Enter Stock Quantity" min="0" value="0">
                    <span class="form-error text-danger" id="error-stock_quantity"></span>
                </div>

                <!-- SKU -->
                <div class="drawer-form-group">
                    <label for="SKU">SKU</label>
                    <input type="text" name="SKU" id="SKU" placeholder="Enter Product SKU">
                    <span class="form-error text-danger" id="error-SKU"></span>
                </div>

                <!-- Rating -->
                <div class="drawer-form-group">
                    <label for="rating">Rating (0-5)</label>
                    <input type="number" name="rating" id="rating" placeholder="Enter Product Rating" step="0.1" min="0" max="5" value="0">
                    <span class="form-error text-danger" id="error-rating"></span>
                </div>

                <!-- Review Count -->
                <div class="drawer-form-group">
                    <label for="review_count">Review Count</label>
                    <input type="number" name="review_count" id="review_count" placeholder="Enter Review Count" min="0" value="0">
                    <span class="form-error text-danger" id="error-review_count"></span>
                </div>

                <!-- Discount Percentage -->
                <div class="drawer-form-group">
                    <label for="discount_percent">Discount Percentage (%)</label>
                    <input type="number" name="discount_percent" id="discount_percent" placeholder="Enter Discount Percentage" step="0.01" min="0" max="100" value="0">
                    <span class="form-error text-danger" id="error-discount_percent"></span>
                </div>

                <!-- Discount Amount -->
                <div class="drawer-form-group">
                    <label for="discount_amount">Discount Amount (PKR)</label>
                    <input type="number" name="discount_amount" id="discount_amount" placeholder="Enter Discount Amount" step="0.01" min="0" value="0">
                    <span class="form-error text-danger" id="error-discount_amount"></span>
                </div>

                <!-- Free Delivery -->
                <div class="drawer-form-group">
                    <label for="has_free_delivery">Free Delivery</label>
                    <select name="has_free_delivery" id="has_free_delivery">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                    <span class="form-error text-danger" id="error-has_free_delivery"></span>
                </div>

                <!-- Delivery Charge -->
                <div class="drawer-form-group">
                    <label for="delivery_charge">Delivery Charge (PKR)</label>
                    <input type="number" name="delivery_charge" id="delivery_charge" placeholder="Enter Delivery Charge" step="0.01" min="0" value="0">
                    <span class="form-error text-danger" id="error-delivery_charge"></span>
                </div>

                <!-- Status -->
                <div class="drawer-form-group">
                    <label for="status">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" required>
                        <option value="active">Active</option>
                        <option value="out_of_stock">Out of Stock</option>
                        <option value="pending_review">Pending Review</option>
                        <option value="banned">Banned</option>
                    </select>
                    <span class="form-error text-danger" id="error-status"></span>
                </div>

                <!-- Product Images -->
                <div class="drawer-form-group">
                    <label>Product Images</label>
                    <div class="image-wrapper">
                        <div class="image-input-group mb-2 d-flex gap-2">
                            <input type="file" name="images[]" class="form-control" accept="image/*">
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
