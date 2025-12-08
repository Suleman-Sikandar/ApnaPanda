<!-- Drawer Overlay -->
<div class="drawer-overlay" id="OrderDrawerModal">

    <!-- Drawer Modal -->
    <div class="drawer" id="OrderDrawerBox">

        <!-- Header -->
        <div class="drawer-header">
            <h2 class="drawer-title">Create New Order</h2>
            <span class="drawer-close">&times;</span>
        </div>

        <!-- Body -->
        <div class="drawer-body">
            <form class="drawer-form" id="orderForm" method="POST">
                @csrf

                <!-- Customer -->
                <div class="drawer-form-group">
                    <label for="customer_id">Customer <span class="text-danger">*</span></label>
                    <select name="customer_id" id="customer_id" required>
                        <option value="">-- Select Customer --</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                    <span class="form-error text-danger" id="error-customer_id"></span>
                </div>

                <!-- Vendor -->
                <div class="drawer-form-group">
                    <label for="vendor_id">Vendor <span class="text-danger">*</span></label>
                    <select name="vendor_id" id="vendor_id" required>
                        <option value="">-- Select Vendor --</option>
                        @foreach ($vendors as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->users->name ?? 'Unknown Vendor' }}</option>
                        @endforeach
                    </select>
                    <span class="form-error text-danger" id="error-vendor_id"></span>
                </div>

                <!-- Status -->
                <div class="drawer-form-group">
                    <label for="order_status">Status <span class="text-danger">*</span></label>
                    <select name="order_status" id="order_status" required>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <span class="form-error text-danger" id="error-order_status"></span>
                </div>

                <!-- Payment Method -->
                <div class="drawer-form-group">
                    <label for="payment_method_id">Payment Method</label>
                    <select name="payment_method_id" id="payment_method_id">
                        <option value="">-- Select Method --</option>
                        @foreach ($paymentMethods as $method)
                            <option value="{{ $method->id }}">{{ $method->payment_methode }}</option>
                        @endforeach
                    </select>
                    <span class="form-error text-danger" id="error-payment_method_id"></span>
                </div>

                <!-- Payment Amount -->
                <div class="drawer-form-group">
                    <label for="payment_amount">Payment Amount</label>
                    <input type="number" name="payment_amount" id="payment_amount" placeholder="Enter amount">
                    <span class="form-error text-danger" id="error-payment_amount"></span>
                </div>

                <!-- Delivery Address -->
                <div class="drawer-form-group">
                    <label for="delivery_address">Delivery Address</label>
                    <div class="input-group">
                        <input type="text" name="delivery_address" id="delivery_address" class="form-control" placeholder="Enter delivery address">
                        <button type="button" class="btn btn-outline-secondary" id="btn-get-location" title="Use Current Location">
                            <i class="bi bi-geo-alt-fill"></i>
                        </button>
                    </div>
                    <span class="form-error text-danger" id="error-delivery_address"></span>
                    
                    <!-- Map Container -->
                    <div id="map-add" style="height: 300px; width: 100%; margin-top: 15px; border-radius: 8px; border: 1px solid #ddd;"></div>
                    <input type="hidden" name="latitude" id="latitude_add">
                    <input type="hidden" name="longitude" id="longitude_add">
                    <input type="hidden" name="city" id="city_add">
                    <input type="hidden" name="province" id="province_add">
                    <input type="hidden" name="country" id="country_add">
                    <input type="hidden" name="postal_code" id="postal_code_add">
                </div>

            </form>
        </div>

        <!-- Footer -->
        <div class="drawer-footer">
            <button type="button" class="btn-cancel" onclick="closeOrderAddDrawer()">Cancel</button>
            <button type="submit" class="btn-submit" form="orderForm">Save Order</button>
        </div>

    </div>
</div>
