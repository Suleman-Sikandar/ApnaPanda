@extends('customer.master')

@section('title', 'Checkout | ApnaPanda')

@section('navBar')
    @include('customer.includes.navBar')
@endsection

@section('categories')
    @include('customer.includes.category')
@endsection

@section('content')
    <div class="checkout-container">
        <div class="container">

            <!-- Progress Steps -->
            <div class="checkout-steps">
                <div class="steps">
                    <div class="step completed">
                        <div class="step-circle">✓</div>
                        <div class="step-label">Cart</div>
                        <div class="step-line"></div>
                    </div>
                    <div class="step active">
                        <div class="step-circle">2</div>
                        <div class="step-label">Address & Payment</div>
                        <div class="step-line"></div>
                    </div>
                    <div class="step">
                        <div class="step-circle">3</div>
                        <div class="step-label">Confirmation</div>
                    </div>
                </div>
            </div>

            <div class="checkout-main">

                <!-- Checkout Content -->
                <div class="checkout-content">

                    <!-- Delivery Address -->
                    <div class="section-card">
                        <div class="section-header">
                            <h3 class="section-title">
                                <i class="fas fa-map-marker-alt text-danger"></i> Delivery Address
                            </h3>
                        </div>

                        <!-- Delivery Address -->
                        <div class="drawer-form-group">
                            <label for="delivery_address">Delivery Address</label>
                            <div class="input-group">
                                <input type="text" name="delivery_address" id="delivery_address" class="form-control"
                                    placeholder="Enter delivery address">
                                <button type="button" class="btn btn-outline-secondary" id="btn-get-location"
                                    title="Use Current Location">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </button>
                            </div>
                            <span class="form-error text-danger" id="error-delivery_address"></span>

                            <!-- Map Container -->
                            <div id="map-add"
                                style="height: 300px; width: 100%; margin-top: 15px; border-radius: 8px; border: 1px solid #ddd;">
                            </div>
                            <input type="hidden" name="latitude" id="latitude_add">
                            <input type="hidden" name="longitude" id="longitude_add">
                            <input type="hidden" name="city" id="city_add">
                            <input type="hidden" name="province" id="province_add">
                            <input type="hidden" name="country" id="country_add">
                            <input type="hidden" name="postal_code" id="postal_code_add">
                        </div>
                    </div>

                    <!-- Delivery Instructions -->
                    <div class="section-card">
                        <div class="section-header">
                            <h3 class="section-title">
                                <i class="fas fa-clipboard-list text-danger"></i> Delivery Instructions
                            </h3>
                        </div>
                        <textarea class="delivery-notes" placeholder="Any specific delivery instructions?"></textarea>
                    </div>

                    <!-- Payment Method -->
                    <div class="section-card">
                        <div class="section-header">
                            <h3 class="section-title">
                                <i class="fas fa-credit-card text-danger"></i> Payment Method
                            </h3>
                        </div>

                        @foreach ($paymentMethods as $method)
                            <label class="payment-method">

                                <input type="radio" name="payment_method_id" value="{{ $method->id }}"
                                    @checked($loop->first)>

                                <div class="payment-icon">
                                    @if ($method->icon)
                                        <img src="{{ asset('storage/' . $method->icon) }}"
                                            alt="{{ $method->payment_methode }}" style="height: 40px; width: 40px;">
                                    @else
                                        <i class="fas fa-money-bill-wave" style="color: #48C774;"></i>
                                    @endif
                                </div>

                                <div class="payment-info">
                                    <div class="payment-name">{{ $method->payment_methode }}</div>
                                    <div class="payment-description">{{ $method->description ?? '' }}</div>
                                </div>

                            </label>
                        @endforeach


                    </div>

                    <!-- Terms -->
                    <div class="section-card">
                        <label style="display:flex; gap:10px;">
                            <input type="checkbox" id="terms">
                            <span>I agree to Terms & Conditions and Privacy Policy.</span>
                        </label>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="order-summary">
                    <div class="summary-card">
                        <h4>Order Summary</h4>

                        @foreach ($cart as $item)
                            <div class="order-item">
                                <span class="item-name">{{ $item->product->name }}</span>
                                <span class="item-qty">× {{ $item->quantity }}</span>
                                <span class="item-price">Rs. {{ number_format($item->subtotal, 0) }}</span>
                            </div>
                        @endforeach

                        <div class="summary-divider"></div>

                        <div class="summary-row">
                            <span>Item Total</span>
                            <span>Rs. {{ number_format($itemTotal, 0) }}</span>
                        </div>

                        <div class="summary-row">
                            <span>Delivery Fee</span>
                            <span>Rs. {{ number_format($deliveryCharge, 0) }}</span>
                        </div>

                        <div class="summary-row">
                            <span>GST (5%)</span>
                            <span>Rs. {{ number_format($gst, 0) }}</span>
                        </div>

                        <div class="summary-row">
                            <span>Discount</span>
                            <span style="color:#48C774;">- Rs. {{ number_format($discount, 0) }}</span>
                        </div>

                        <div class="summary-row total">
                            <span>Total Amount</span>
                            <span>Rs. {{ number_format($totalAmount, 0) }}</span>
                        </div>

                        <a href="#" class="place-order-btn" onclick="placeOrder(event)">
                            <i class="fas fa-check-circle"></i> Place Order
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

<style>
    .payment-method {
        display: flex;
        align-items: center;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-bottom: 10px;
        cursor: pointer;
    }

    .payment-method input[type="radio"] {
        margin-right: 12px;
    }
</style>

@push('scripts')
    @push('scripts')
        {{-- Load Google API correctly --}}
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxAPwCneWCcdxQFDOLJ_hGMJk1ruf5AwU&libraries=places&callback=initAddMap"
            async defer></script>

        <script>
            let mapAdd;
            let markerAdd;
            let geocoder;

            function initAddMap() {
                geocoder = new google.maps.Geocoder();

                const defaultLoc = {
                    lat: 31.5204,
                    lng: 74.3587
                };

                // MAP INIT
                mapAdd = new google.maps.Map(document.getElementById("map-add"), {
                    center: defaultLoc,
                    zoom: 13,
                    streetViewControl: false,
                });

                markerAdd = new google.maps.Marker({
                    position: defaultLoc,
                    map: mapAdd,
                    draggable: true,
                    title: "Drag to exact location"
                });

                setupMap(
                    "delivery_address",
                    mapAdd,
                    markerAdd,
                    "latitude_add",
                    "longitude_add",
                    "city_add",
                    "province_add",
                    "country_add",
                    "postal_code_add"
                );
            }

            function setupMap(inputId, mapObj, markerObj, latId, lngId, cityId, stateId, countryId, zipId) {
                const input = document.getElementById(inputId);

                const autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.bindTo("bounds", mapObj);

                autocomplete.setFields(["address_components", "geometry", "formatted_address"]);

                autocomplete.addListener("place_changed", () => {
                    const place = autocomplete.getPlace();
                    if (!place.geometry) return;

                    fillComponents(place, cityId, stateId, countryId, zipId);

                    mapObj.setCenter(place.geometry.location);
                    mapObj.setZoom(17);

                    markerObj.setPosition(place.geometry.location);

                    document.getElementById(latId).value = place.geometry.location.lat();
                    document.getElementById(lngId).value = place.geometry.location.lng();
                });

                // Marker drag
                markerObj.addListener("dragend", () => updateFromMarker(markerObj, input, latId, lngId, cityId, stateId,
                    countryId, zipId));

                // Map click
                mapObj.addListener("click", (e) => {
                    markerObj.setPosition(e.latLng);
                    updateFromMarker(markerObj, input, latId, lngId, cityId, stateId, countryId, zipId);
                });
            }

            function updateFromMarker(markerObj, input, latId, lngId, cityId, stateId, countryId, zipId) {
                const pos = markerObj.getPosition();

                document.getElementById(latId).value = pos.lat();
                document.getElementById(lngId).value = pos.lng();

                geocoder.geocode({
                    location: pos
                }, (results, status) => {
                    if (status === "OK" && results[0]) {
                        input.value = results[0].formatted_address;
                        fillComponents(results[0], cityId, stateId, countryId, zipId);
                    }
                });
            }

            function fillComponents(place, cityId, stateId, countryId, zipId) {
                let city = "",
                    state = "",
                    country = "",
                    postalCode = "";

                place.address_components.forEach(c => {
                    if (c.types.includes("locality")) city = c.long_name;
                    if (c.types.includes("administrative_area_level_1")) state = c.long_name;
                    if (c.types.includes("country")) country = c.long_name;
                    if (c.types.includes("postal_code")) postalCode = c.long_name;
                });

                document.getElementById(cityId).value = city;
                document.getElementById(stateId).value = state;
                document.getElementById(countryId).value = country;
                document.getElementById(zipId).value = postalCode;
            }

            // Current Location Button
            document.addEventListener("DOMContentLoaded", () => {
                document.getElementById("btn-get-location").addEventListener("click", () => {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition((pos) => {
                            const loc = {
                                lat: pos.coords.latitude,
                                lng: pos.coords.longitude,
                            };

                            mapAdd.setCenter(loc);
                            mapAdd.setZoom(17);
                            markerAdd.setPosition(loc);

                            document.getElementById("latitude_add").value = loc.lat;
                            document.getElementById("longitude_add").value = loc.lng;

                            geocoder.geocode({
                                location: loc
                            }, (res, status) => {
                                if (status === "OK" && res[0]) {
                                    document.getElementById("delivery_address").value = res[0]
                                        .formatted_address;
                                }
                            });
                        });
                    } else {
                        alert("Geolocation not supported.");
                    }
                });
            });
        </script>
    @endpush

@endpush

<script>
    function placeOrder(event) {
        event.preventDefault();

        const deliveryAddress = document.getElementById('delivery_address').value;
        const latitude = document.getElementById('latitude_add').value;
        const longitude = document.getElementById('longitude_add').value;
        const city = document.getElementById('city_add').value;
        const province = document.getElementById('province_add').value;
        const country = document.getElementById('country_add').value;
        const postalCode = document.getElementById('postal_code_add').value;
        const paymentMethod = document.querySelector('input[name="payment_method_id"]:checked');
        const termsAccepted = document.getElementById('terms').checked;
        const deliveryInstructions = document.querySelector('.delivery-notes').value;

        let hasError = false;

        // Validate Delivery Address
        if (!deliveryAddress || !latitude || !longitude) {
            document.getElementById('error-delivery_address').innerText = 'Please enter a delivery address.';
            hasError = true;
        } else {
            document.getElementById('error-delivery_address').innerText = '';
        }

        // Validate Payment Method
        if (!paymentMethod) {
            alert('Please select a payment method.');
            hasError = true;
        }

        // Validate Terms & Conditions
        if (!termsAccepted) {
            alert('You must agree to the Terms & Conditions and Privacy Policy.');
            hasError = true;
        }

        if (hasError) {
            return;
        }

        // If all validations pass, proceed with order placement (AJAX call)
        const data = {
            _token: '{{ csrf_token() }}',
            delivery_address: deliveryAddress,
            latitude: latitude,
            longitude: longitude,
            city: city,
            province: province,
            country: country,
            postal_code: postalCode,
            payment_method_id: paymentMethod.value,
            delivery_instructions: deliveryInstructions,
        };

        fetch('{{ route('customer.placeOrder') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                    }).then(() => {
                        window.location.href =
                        '{{ route('customer.orders') }}'; // Redirect to order confirmation page or dashboard
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Error: ' + data.message,
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while placing the order.',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                });
            });
    }
</script>
