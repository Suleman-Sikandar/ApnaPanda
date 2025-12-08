<!-- Drawer Overlay -->
<div class="drawer-overlay" id="OrderItemDrawerModal">

    <!-- Drawer Modal -->
    <div class="drawer" id="OrderItemDrawerBox">

        <!-- Header -->
        <div class="drawer-header">
            <h2 class="drawer-title">Add Order Item</h2>
            <span class="drawer-close">&times;</span>
        </div>

        <!-- Body -->
        <div class="drawer-body">
            <form class="drawer-form" id="orderItemForm" method="POST">
                @csrf

                <!-- Order ID -->
                <div class="drawer-form-group">
                    <label for="order_id">Order ID <span class="text-danger">*</span></label>
                    <select name="order_id" id="order_id" required>
                        <option value="">-- Select Order --</option>
                        @foreach ($orders as $order)
                            <option value="{{ $order->id }}">Order #{{ $order->id }} - {{ $order->customer->name ?? 'Guest' }}</option>
                        @endforeach
                    </select>
                    <span class="form-error text-danger" id="error-order_id"></span>
                </div>

                <!-- Product Category -->
                <div class="drawer-form-group">
                    <label for="product_category_id">Category</label>
                    <select name="product_category_id" id="product_category_id">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                    <span class="form-error text-danger" id="error-product_category_id"></span>
                </div>

                <!-- Product -->
                <div class="drawer-form-group">
                    <label for="product_id">Product</label>
                    <select name="product_id" id="product_id">
                        <option value="">-- Select Product --</option>
                        @foreach ($products as $prod)
                            <option value="{{ $prod->id }}">{{ $prod->name }}</option>
                        @endforeach
                    </select>
                    <span class="form-error text-danger" id="error-product_id"></span>
                </div>

                <!-- Unit Price -->
                <div class="drawer-form-group">
                    <label for="unit_price">Unit Price</label>
                    <input type="number" name="unit_price" id="unit_price" placeholder="Enter unit price">
                    <span class="form-error text-danger" id="error-unit_price"></span>
                </div>

                <!-- Quantity -->
                <div class="drawer-form-group">
                    <label for="quantity">Quantity <span class="text-danger">*</span></label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" required>
                    <span class="form-error text-danger" id="error-quantity"></span>
                </div>

            </form>
        </div>

        <!-- Footer -->
        <div class="drawer-footer">
            <button type="button" class="btn-cancel" onclick="closeOrderItemAddDrawer()">Cancel</button>
            <button type="submit" class="btn-submit" form="orderItemForm">Save Item</button>
        </div>

    </div>
</div>
