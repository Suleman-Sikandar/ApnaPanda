<div class="content-section">
    <div class="section-header">
        <h2 class="section-title">Address Information</h2>
        <p style="color: #6b7280; font-size: 14px;">Provide your business address</p>
    </div>
    <form action="{{ url('vendor/address/' . $vendor->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-grid">

            <!-- Address -->
            <div class="form-group" style="grid-column: 1 / -1;">
                <label class="form-label">Address <span style="color:red;">*</span></label>
                <input type="text" class="form-control @error('address') is-invalid @enderror"
                    name="address" id="address-input" value="{{ old('address', $vendor->address) }}" required>
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- City -->
            <div class="form-group">
                <label class="form-label">City <span style="color:red;">*</span></label>
                <input type="text" class="form-control @error('city') is-invalid @enderror"
                    name="city" value="{{ old('city', $vendor->city) }}" required>
                @error('city')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Province/State -->
            <div class="form-group">
                <label class="form-label">Province/State <span style="color:red;">*</span></label>
                <input type="text" class="form-control @error('province') is-invalid @enderror"
                    name="province" value="{{ old('province', $vendor->province) }}" required>
                @error('province')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Postal Code -->
            <div class="form-group">
                <label class="form-label">Postal Code <span style="color:red;">*</span></label>
                <input type="text" class="form-control @error('postal_code') is-invalid @enderror"
                    name="postal_code" value="{{ old('postal_code', $vendor->postal_code) }}" required>
                @error('postal_code')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Country -->
            <div class="form-group">
                <label class="form-label">Country <span style="color:red;">*</span></label>
                <input type="text" class="form-control @error('country') is-invalid @enderror"
                    name="country" value="{{ old('country', $vendor->country) }}" required>
                @error('country')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Latitude -->
            <div class="form-group">
                <label class="form-label">Latitude</label>
                <input type="text" class="form-control @error('latitude') is-invalid @enderror"
                    name="latitude" value="{{ old('latitude', $vendor->latitude) }}" readonly>
                @error('latitude')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Longitude -->
            <div class="form-group">
                <label class="form-label">Longitude</label>
                <input type="text" class="form-control @error('longitude') is-invalid @enderror"
                    name="longitude" value="{{ old('longitude', $vendor->longitude) }}" readonly>
                @error('longitude')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </div>
        <button type="submit" class="save-btn">
            <i class="fas fa-arrow-right"></i> Save & Next
        </button>
    </form>
</div>

@push('scripts')
<!-- Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxAPwCneWCcdxQFDOLJ_hGMJk1ruf5AwU&libraries=places&callback=initAutocomplete" async defer></script>

<script>
    function initAutocomplete() {
        const input = document.getElementById('address-input');
        if (!input) return;

        const autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.setFields(['address_components', 'geometry', 'icon', 'name']);

        autocomplete.addListener('place_changed', function() {
            const place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            // Fill Latitude and Longitude
            document.querySelector('input[name="latitude"]').value = place.geometry.location.lat();
            document.querySelector('input[name="longitude"]').value = place.geometry.location.lng();

            // Fill other fields
            let city = '';
            let state = '';
            let country = '';
            let postal_code = '';

            for (const component of place.address_components) {
                const componentType = component.types[0];
                switch (componentType) {
                    case 'locality':
                        city = component.long_name;
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

            if(document.querySelector('input[name="city"]')) document.querySelector('input[name="city"]').value = city;
            if(document.querySelector('input[name="province"]')) document.querySelector('input[name="province"]').value = state;
            if(document.querySelector('input[name="country"]')) document.querySelector('input[name="country"]').value = country;
            if(document.querySelector('input[name="postal_code"]')) document.querySelector('input[name="postal_code"]').value = postal_code;
        });
    }
</script>
@endpush
