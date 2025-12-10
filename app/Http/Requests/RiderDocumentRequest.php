<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RiderDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'license_front'     => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
            'license_back'      => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
            'national_id_front' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
            'national_id_back'  => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
        ];
    }
}

