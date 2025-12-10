<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RiderAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'address'     => ['required', 'string', 'max:500'],
            'city'        => ['required', 'string', 'max:255'],
            'province'    => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:20'],
            'country'     => ['required', 'string', 'max:255'],
            'latitude'    => ['nullable', 'numeric', 'between:-90,90'],
            'longitude'   => ['nullable', 'numeric', 'between:-180,180'],
        ];
    }
}

