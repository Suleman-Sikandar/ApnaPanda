// Google Maps for Order Address Selection
let mapAdd, markerAdd, mapEdit, markerEdit;

// Initialize maps when modals open
$(document).ready(function () {

    // Initialize Add Order Map
    $('#orderAdd').on('click', function () {
        setTimeout(function () {
            initMapAdd();
        }, 300);
    });

    // Initialize Edit Order Map
    $(document).on('click', '.editOrder', function () {
        setTimeout(function () {
            initMapEdit();
        }, 300);
    });

    // Get current location for Add modal
    $('#btn-get-location').on('click', function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                mapAdd.setCenter(pos);
                markerAdd.setPosition(pos);
                mapAdd.setZoom(17);
                updateAddressAdd(pos);
            }, function () {
                alert('Unable to get your location');
            });
        } else {
            alert('Geolocation is not supported by your browser');
        }
    });

    // Get current location for Edit modal
    $('#btn-get-location-edit').on('click', function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                mapEdit.setCenter(pos);
                markerEdit.setPosition(pos);
                mapEdit.setZoom(17);
                updateAddressEdit(pos);
            }, function () {
                alert('Unable to get your location');
            });
        } else {
            alert('Geolocation is not supported by your browser');
        }
    });
});

// Initialize Add Map
function initMapAdd() {
    const defaultPos = { lat: 31.5204, lng: 74.3587 }; // Lahore, Pakistan

    mapAdd = new google.maps.Map(document.getElementById('map-add'), {
        center: defaultPos,
        zoom: 12
    });

    markerAdd = new google.maps.Marker({
        position: defaultPos,
        map: mapAdd,
        draggable: true
    });

    // Listen for marker drag
    markerAdd.addListener('dragend', function () {
        updateAddressAdd(markerAdd.getPosition());
    });

    // Listen for map click
    mapAdd.addListener('click', function (e) {
        markerAdd.setPosition(e.latLng);
        updateAddressAdd(e.latLng);
    });

    // Add search box
    const input = document.getElementById('delivery_address');
    const searchBox = new google.maps.places.SearchBox(input);

    searchBox.addListener('places_changed', function () {
        const places = searchBox.getPlaces();
        if (places.length > 0) {
            const place = places[0];
            mapAdd.setCenter(place.geometry.location);
            markerAdd.setPosition(place.geometry.location);
            mapAdd.setZoom(17);
            updateAddressAdd(place.geometry.location);
        }
    });
}

// Initialize Edit Map
function initMapEdit() {
    const defaultPos = { lat: 31.5204, lng: 74.3587 }; // Lahore, Pakistan

    mapEdit = new google.maps.Map(document.getElementById('map-edit'), {
        center: defaultPos,
        zoom: 12
    });

    markerEdit = new google.maps.Marker({
        position: defaultPos,
        map: mapEdit,
        draggable: true
    });

    // Listen for marker drag
    markerEdit.addListener('dragend', function () {
        updateAddressEdit(markerEdit.getPosition());
    });

    // Listen for map click
    mapEdit.addListener('click', function (e) {
        markerEdit.setPosition(e.latLng);
        updateAddressEdit(e.latLng);
    });

    // Add search box
    const input = document.getElementById('edit_delivery_address');
    const searchBox = new google.maps.places.SearchBox(input);

    searchBox.addListener('places_changed', function () {
        const places = searchBox.getPlaces();
        if (places.length > 0) {
            const place = places[0];
            mapEdit.setCenter(place.geometry.location);
            markerEdit.setPosition(place.geometry.location);
            mapEdit.setZoom(17);
            updateAddressEdit(place.geometry.location);
        }
    });
}

// Update address and location details for Add modal
function updateAddressAdd(location) {
    const geocoder = new google.maps.Geocoder();

    geocoder.geocode({ location: location }, function (results, status) {
        if (status === 'OK' && results[0]) {
            $('#delivery_address').val(results[0].formatted_address);
            $('#latitude_add').val(location.lat());
            $('#longitude_add').val(location.lng());

            // Extract address components
            const addressComponents = results[0].address_components;
            addressComponents.forEach(function (component) {
                if (component.types.includes('locality')) {
                    $('#city_add').val(component.long_name);
                }
                if (component.types.includes('administrative_area_level_1')) {
                    $('#province_add').val(component.long_name);
                }
                if (component.types.includes('country')) {
                    $('#country_add').val(component.long_name);
                }
                if (component.types.includes('postal_code')) {
                    $('#postal_code_add').val(component.long_name);
                }
            });
        }
    });
}

// Update address and location details for Edit modal
function updateAddressEdit(location) {
    const geocoder = new google.maps.Geocoder();

    geocoder.geocode({ location: location }, function (results, status) {
        if (status === 'OK' && results[0]) {
            $('#edit_delivery_address').val(results[0].formatted_address);
            $('#latitude_edit').val(location.lat());
            $('#longitude_edit').val(location.lng());

            // Extract address components
            const addressComponents = results[0].address_components;
            addressComponents.forEach(function (component) {
                if (component.types.includes('locality')) {
                    $('#city_edit').val(component.long_name);
                }
                if (component.types.includes('administrative_area_level_1')) {
                    $('#province_edit').val(component.long_name);
                }
                if (component.types.includes('country')) {
                    $('#country_edit').val(component.long_name);
                }
                if (component.types.includes('postal_code')) {
                    $('#postal_code_edit').val(component.long_name);
                }
            });
        }
    });
}
