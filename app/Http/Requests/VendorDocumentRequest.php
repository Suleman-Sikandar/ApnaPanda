<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'cnic_front' => 'required|file|mimes:jpg,jpeg,png,pdf',
            'cnic_back' => 'required|file|mimes:jpg,jpeg,png,pdf',
            'registration_certificate' => 'required|file|mimes:jpg,jpeg,png,pdf',
            'GST_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'PAN_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'shop_image' => 'nullable|image|mimes:jpg,jpeg,png',
        ];
    }
}
