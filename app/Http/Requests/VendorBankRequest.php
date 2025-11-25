<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorBankRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'account_holder_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:50',
            'bank_name' => 'required|string|max:255',
            'IFSC_code' => 'required|string|max:20',
            'branch_name' => 'nullable|string|max:255',
            'account_type' => 'required|in:Savings,Current',
        ];
    }
}
