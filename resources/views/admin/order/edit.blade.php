<!-- Drawer Overlay -->
<div class="drawer-overlay" id="EditOrderDrawerModal">

    <!-- Drawer Modal -->
    <div class="drawer" id="EditOrderDrawerBox">

        <!-- Header -->
        <div class="drawer-header">
            <h2 class="drawer-title">Edit Order</h2>
            <span class="drawer-close">&times;</span>
        </div>

        <!-- Body -->
        <div class="drawer-body">
            <form class="drawer-form" id="editOrderForm" method="POST">
                @csrf
                {{-- @method('PUT')  --}}

                <!-- Customer -->
                <div class="drawer-form-group">
                    <label for="edit_customer_id">Customer <span class="text-danger">*</span></label>
                    <select name="customer_id" id="edit_customer_id" required>
                        <option value="">-- Select Customer --</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                    <span class="form-error text-danger" id="error-customer_id"></span>
                </div>

                <!-- Vendor -->
                <div class="drawer-form-group">
                    <label for="edit_vendor_id">Vendor <span class="text-danger">*</span></label>
                    <select name="vendor_id" id="edit_vendor_id" required>
                        <option value="">-- Select Vendor --</option>
                        @foreach ($vendors as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->users->name ?? 'Unknown Vendor' }}</option>
                        @endforeach
                    </select>
                    <span class="form-error text-danger" id="error-vendor_id"></span>
                </div>

                <!-- Status -->
                <div class="drawer-form-group">
                    <label for="edit_order_status">Status <span class="text-danger">*</span></label>
                    <select name="order_status" id="edit_order_status" required>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <span class="form-error text-danger" id="error-order_status"></span>
                </div>

                <!-- Payment Method -->
                <div class="drawer-form-group">
                    <label for="edit_payment_method_id">Payment Method</label>
                    <select name="payment_method_id" id="edit_payment_method_id">
                        <option value="">-- Select Method --</option>
                        @foreach ($paymentMethods as $method)
                            <option value="{{ $method->id }}">{{ $method->payment_methode }}</option>
                        @endforeach
                    </select>
                    <span class="form-error text-danger" id="error-payment_method_id"></span>
                </div>

                <!-- Payment Amount -->
                <div class="drawer-form-group">
                    <label for="edit_payment_amount">Payment Amount</label>
                    <input type="number" name="payment_amount" id="edit_payment_amount">
                    <span class="form-error text-danger" id="error-payment_amount"></span>
                </div>

                <!-- Delivery Address -->
                <div class="drawer-form-group">
                    <label for="edit_delivery_address">Delivery Address</label>
                    <div class="input-group">
                        <input type="text" name="delivery_address" id="edit_delivery_address" class="form-control" placeholder="Enter delivery address">
                        <button type="button" class="btn btn-outline-secondary" id="btn-get-location-edit" title="Use Current Location">
                            <i class="bi bi-geo-alt-fill"></i>
                        </button>
                    </div>
                    <span class="form-error text-danger" id="error-delivery_address"></span>

                    <!-- Map Container -->
                    <div id="map-edit" style="height: 300px; width: 100%; margin-top: 15px; border-radius: 8px; border: 1px solid #ddd;"></div>
                    <input type="hidden" name="latitude" id="latitude_edit">
                    <input type="hidden" name="longitude" id="longitude_edit">
                    <input type="hidden" name="city" id="city_edit">
                    <input type="hidden" name="province" id="province_edit">
                    <input type="hidden" name="country" id="country_edit">
                    <input type="hidden" name="postal_code" id="postal_code_edit">
                </div>

                <!-- Order Status Logs -->
                <div class="drawer-form-group">
                    <label>Order Status History</label>
                    <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Status</th>
                                    <th>Changed By</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody id="orderStatusLogsBody">
                                <!-- Logs will be appended here -->
                            </tbody>
                        </table>
                    </div>
                </div>

            </form>
        </div>

        <!-- Footer -->
        <div class="drawer-footer">
            <button type="button" class="btn-cancel" onclick="closeOrderEditDrawer()">Cancel</button>
            <button type="submit" class="btn-submit" form="editOrderForm">Update Order</button>
        </div>

    </div>
</div>
