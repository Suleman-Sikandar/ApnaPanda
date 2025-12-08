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
        $userId = $this->route('id');
        // Determine if files already exist to make them nullable
        // We use finding by user_id since that's the context we have
        $vendor = \App\Models\TblVendorModel::where('user_id', $userId)->first();

        $isRequired = function ($attribute) use ($vendor) {
            return ($vendor && !empty($vendor->$attribute)) ? 'nullable' : 'required';
        };

        return [
            'cnic_front' => $isRequired('cnic_front') . '|file|mimes:jpg,jpeg,png,pdf',
            'cnic_back' => $isRequired('cnic_back') . '|file|mimes:jpg,jpeg,png,pdf',
            'registration_certificate' => $isRequired('registration_certificate') . '|file|mimes:jpg,jpeg,png,pdf',
            'GST_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'PAN_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'shop_image' => 'nullable|image|mimes:jpg,jpeg,png',
        ];
    }
}
