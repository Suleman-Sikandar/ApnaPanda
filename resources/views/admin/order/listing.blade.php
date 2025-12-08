@extends('admin.layouts.master')

@section('title', 'Orders | ApnaPanda')

@section('sidebar')
    @include('admin.includes.sidebar')
@endsection

@section('header')
    @include('admin.includes.header')
@endsection

@section('content')

<div class="role-dashboard-container">

    {{-- HEADER --}}
    <div class="role-header-card">
        <div class="role-header-left">
            <h2 class="role-page-title">
                {{ $filterStatus ? ucfirst($filterStatus) . ' Orders' : 'All Orders' }}
            </h2>
            <p class="role-page-subtitle">Manage customer orders.</p>
        </div>
        <div class="role-header-actions">
            @if(validatePermissions('admin/orders/store'))
                <button class="role-btn-primary-gradient" id="orderAdd">
                    <i class="bi bi-plus-lg"></i> Create Order
                </button>
            @endif
        </div>
    </div>

    {{-- LISTING --}}
    <div class="role-table-card">
        <div class="role-table-header">
            <h3 class="role-table-title">Order List</h3>
            <div class="role-table-search">
                <div class="role-search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search orders..." id="orderSearchInput">
                </div>
            </div>
        </div>

        <table class="role-data-table data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Vendor</th>
                    <th>Status</th>
                    <th>Amount</th>
                    <th>Payment Method</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer->name ?? 'N/A' }}</td>
                    <td>{{ $order->vendor->users->name ?? 'N/A' }}</td>
                    <td>
                        @if ($order->order_status === 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($order->order_status === 'processing')
                             <span class="badge bg-info text-white">Processing</span>
                        @elseif($order->order_status === 'completed')
                            <span class="badge bg-success">Completed</span>
                        @elseif($order->order_status === 'cancelled')
                            <span class="badge bg-danger">Cancelled</span>
                        @else
                            <span class="badge bg-secondary">{{ $order->order_status }}</span>
                        @endif
                    </td>
                    <td>PKR {{ number_format($order->payment_amount) }}</td>
                    <td>{{ $order->paymentMethod->payment_methode ?? 'N/A' }}</td>
                    <td>
                        <div class="role-action-buttons">
                        @if (validatePermissions('admin/orders/detail/{id}'))
                             <a href="{{ route('admin.orders.show', $order->id) }}" class="role-btn-icon role-btn-view text-dark" title="View Details">
                                <i class="bi bi-eye"></i>
                            </a>
                        @endif   
                           

                            @if(validatePermissions('admin/orders/edit/{id}'))
                                <button class="role-btn-icon role-btn-edit editOrder" title="Edit" data-id="{{ $order->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            @endif

                            @if(validatePermissions('admin/orders/delete/{id}'))
                                <button class="role-btn-icon role-btn-delete deleteOrder" title="Delete" data-id="{{ $order->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('admin.order.add')
    @include('admin.order.edit')

</div>

@endsection

@section('footer')
    @include('admin.includes.footer')
@endsection

@push('scripts')
    <script src="{{ asset('admin/js/order.js') }}"></script>
    
    <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxAPwCneWCcdxQFDOLJ_hGMJk1ruf5AwU&libraries=places&callback=initAllAutocompletes" async defer></script>

    <style>
        /* Fix Google Maps Autocomplete z-index issue in Modals */
        .pac-container {
            z-index: 10000 !important;
        }
    </style>

    <script>
        let mapAdd, mapEdit;
        let markerAdd, markerEdit;
        let geocoder;

        function initAllAutocompletes() {
            geocoder = new google.maps.Geocoder();
            
            // Default Location (e.g., Lahore or center of simple view)
            const defaultLoc = { lat: 31.5204, lng: 74.3587 }; 

            // --- ADD ORDER MAP ---
            mapAdd = new google.maps.Map(document.getElementById("map-add"), {
                center: defaultLoc,
                zoom: 13,
                mapTypeControl: false,
                streetViewControl: false,
                // fullscreenControl: false
            });

            markerAdd = new google.maps.Marker({
                position: defaultLoc,
                map: mapAdd,
                draggable: true,
                title: "Drag me to exact location"
            });


            setupMap("map-add", "delivery_address", mapAdd, markerAdd, "latitude_add", "longitude_add", "city_add", "province_add", "country_add", "postal_code_add");


            // --- EDIT ORDER MAP ---
            mapEdit = new google.maps.Map(document.getElementById("map-edit"), {
                center: defaultLoc,
                zoom: 13,
                mapTypeControl: false,
                streetViewControl: false,
            });

            markerEdit = new google.maps.Marker({
                position: defaultLoc,
                map: mapEdit,
                draggable: true,
                title: "Drag me to exact location"
            });

            setupMap("map-edit", "edit_delivery_address", mapEdit, markerEdit, "latitude_edit", "longitude_edit", "city_edit", "province_edit", "country_edit", "postal_code_edit");
        }
        
        // ... (Keep Resizing Logic) ...

        function setupMap(mapId, inputId, mapObj, markerObj, latId, lngId, cityId, stateId, countryId, zipId) {
            const input = document.getElementById(inputId);
            const latInput = document.getElementById(latId);
            const lngInput = document.getElementById(lngId);
            const cityInput = document.getElementById(cityId);
            const stateInput = document.getElementById(stateId);
            const countryInput = document.getElementById(countryId);
            const zipInput = document.getElementById(zipId);

            // Prevent form submission on Enter ...

            // 1. Autocomplete
            const autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo("bounds", mapObj);
            autocomplete.setFields(['address_components', 'geometry', 'icon', 'name', 'formatted_address']); // Need address_components now

            autocomplete.addListener("place_changed", () => {
                const place = autocomplete.getPlace();
                
                if (!place.geometry || !place.geometry.location) {
                    return;
                }

                // Fill Components
                fillAddressComponents(place, cityInput, stateInput, countryInput, zipInput);

                // Map/Marker Update ...
                if (place.geometry.viewport) {
                    mapObj.fitBounds(place.geometry.viewport);
                } else {
                    mapObj.setCenter(place.geometry.location);
                    mapObj.setZoom(17);
                }
                
                markerObj.setPosition(place.geometry.location);
                markerObj.setVisible(true);

                // Update hidden inputs
                if(latInput) latInput.value = place.geometry.location.lat();
                if(lngInput) lngInput.value = place.geometry.location.lng();
            });


            // 2. Marker Drag End -> Reverse Geocode
            markerObj.addListener("dragend", () => {
                const pos = markerObj.getPosition();
                if(latInput) latInput.value = pos.lat();
                if(lngInput) lngInput.value = pos.lng();

                geocoder.geocode({ location: pos }, (results, status) => {
                    if (status === "OK") {
                        if (results[0]) {
                            input.value = results[0].formatted_address;
                             fillAddressComponents(results[0], cityInput, stateInput, countryInput, zipInput);
                        } 
                    }
                });
            });

            // 3. Map Click -> Move Marker & Reverse Geocode
            mapObj.addListener("click", (e) => {
                markerObj.setPosition(e.latLng);
                // Trigger dragend logic manually
                google.maps.event.trigger(markerObj, 'dragend');
                
                const pos = e.latLng;
                 if(latInput) latInput.value = pos.lat();
                 if(lngInput) lngInput.value = pos.lng();
                 
                  geocoder.geocode({ location: pos }, (results, status) => {
                    if (status === "OK") {
                        if (results[0]) {
                            input.value = results[0].formatted_address;
                            fillAddressComponents(results[0], cityInput, stateInput, countryInput, zipInput);
                        } 
                    }
                });
            });
        }

        function fillAddressComponents(place, cityInput, stateInput, countryInput, zipInput) {
            let city = '';
            let state = '';
            let country = '';
            let postal_code = '';

            if(place.address_components) {
                for (const component of place.address_components) {
                    const componentType = component.types[0];
                    switch (componentType) {
                        case 'locality':
                            city = component.long_name;
                            break;
                         case 'administrative_area_level_2': // Fallback if locality is missing
                            if(!city) city = component.long_name;
                            break;
                        case 'administrative_area_level_1':
                            state = component.long_name;
                            break;
                        case 'country':
                            country = component.long_name;
                            break;
                        case 'postal_code':
                            postal_code = component.long_name;
                            break;
                    }
                }
            }

            if(cityInput) cityInput.value = city;
            if(stateInput) stateInput.value = state;
            if(countryInput) countryInput.value = country;
            if(zipInput) zipInput.value = postal_code;
        }




        // Current Location Logic (Updated to center map)
        function getCurrentLocation(inputId, mapType) {
            if (navigator.geolocation) {
                const input = document.getElementById(inputId);
                const originalPlaceholder = input.placeholder;
                input.placeholder = "Fetching location...";

                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };

                        let mapObj = (mapType === 'add') ? mapAdd : mapEdit;
                        let markerObj = (mapType === 'add') ? markerAdd : markerEdit;
                        let latId = (mapType === 'add') ? 'latitude_add' : 'latitude_edit';
                        let lngId = (mapType === 'add') ? 'longitude_add' : 'longitude_edit';

                        mapObj.setCenter(pos);
                        mapObj.setZoom(17);
                        markerObj.setPosition(pos);

                        // Trigger reverse geocoding via marker drag logic (or call direct)
                        // Setting position doesn't trigger dragend, so we call simple geocode
                        document.getElementById(latId).value = pos.lat;
                        document.getElementById(lngId).value = pos.lng;

                        geocoder.geocode({ location: pos }, (results, status) => {
                            if (status === "OK") {
                                if (results[0]) {
                                    input.value = results[0].formatted_address;
                                }
                            }
                            input.placeholder = originalPlaceholder;
                        });
                    },
                    (error) => {
                        console.error("Error fetching location", error);
                        input.placeholder = originalPlaceholder;
                        alert("Error fetching location. Please allow location access.");
                    }
                );
            } else {
                alert("Browser doesn't support Geolocation");
            }
        }

        // Event Listeners for Buttons
        document.addEventListener('DOMContentLoaded', function() {
            const btnAdd = document.getElementById('btn-get-location');
            if(btnAdd) {
                btnAdd.addEventListener('click', function() {
                    getCurrentLocation('delivery_address', 'add');
                });
            }

            const btnEdit = document.getElementById('btn-get-location-edit');
            if(btnEdit) {
                btnEdit.addEventListener('click', function() {
                    getCurrentLocation('edit_delivery_address', 'edit');
                });
            }
        });

    </script>
@endpush
