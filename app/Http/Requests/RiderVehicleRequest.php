<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RiderVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'vehicle_type'    => ['required', 'string', 'max:255'],
            'vehicle_number'  => ['required', 'string', 'max:255'],
            'license_number'  => ['required', 'string', 'max:255'],
            'license_expiry'  => ['nullable', 'date'],
            'national_id_number' => ['nullable', 'string', 'max:255'],
        ];
    }
}

