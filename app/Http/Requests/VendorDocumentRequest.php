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
            'cnic_front' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'cnic_back' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'registration_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'GST_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'PAN_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'shop_image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ];
    }
}
