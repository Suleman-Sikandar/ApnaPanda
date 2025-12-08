<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessInformationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
 
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        return [

            // ===== Business Information =====
            'business_name'                 => [
                'required', 'string', 'max:255',
                \Illuminate\Validation\Rule::unique('tbl_vendors', 'business_name')->ignore($this->route('id'), 'user_id'),
            ],
            'business_type'                 => 'required|string|max:255',
            'category'                      => 'required|string|max:255',
            'business_registration_number'  => [
                'nullable', 'string', 'max:255',
                \Illuminate\Validation\Rule::unique('tbl_vendors', 'business_registration_number')->ignore($this->route('id'), 'user_id'),
            ],
            'GST_number'                    => [
                'nullable', 'string', 'max:50',
                \Illuminate\Validation\Rule::unique('tbl_vendors', 'GST_number')->ignore($this->route('id'), 'user_id'),
            ],
            'PAN_number'                    => [
                'nullable', 'string', 'max:50',
                \Illuminate\Validation\Rule::unique('tbl_vendors', 'PAN_number')->ignore($this->route('id'), 'user_id'),
            ],
            'business_email'                => [
                'nullable', 'email', 'max:255',
                \Illuminate\Validation\Rule::unique('tbl_vendors', 'business_email')->ignore($this->route('id'), 'user_id'),
            ],
            'business_phone'                => [
                'required', 'string', 'min:10', 'max:20',
                \Illuminate\Validation\Rule::unique('tbl_vendors', 'business_phone')->ignore($this->route('id'), 'user_id'),
            ],
            'alternative_phone'             => 'nullable|string|min:10|max:20',
            'establishment_year'            => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'website_url'                   => 'nullable|url|max:255',
            'description'                   => 'nullable|string|max:2000',

            //     // ===== Bank Information =====
            //     'account_holder_name' => 'required|string|max:255',
            //     'account_number' => 'required|string|max:30',
            //     'bank_name' => 'required|string|max:255',
            //     'IFSC_code' => 'required|string|max:20',
            //     'branch_name' => 'required|string|max:255',
            //     'account_type' => 'required|string|in:savings,current,other',

            //     // ===== Address Information =====
            //     'address' => 'required|string|max:500',
            //     'city' => 'required|string|max:255',
            //     'province' => 'required|string|max:255',
            //     'postal_code' => 'required|string|max:20',
            //     'country' => 'required|string|max:255',
            //     'latitude' => 'nullable|numeric|between:-90,90',
            //     'longitude' => 'nullable|numeric|between:-180,180',

            //     // ===== Documents =====
            //     'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            //     'cnic_front' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            //     'cnic_back' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            //     'registeration_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
            //     'GST_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
            //     'PAN_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
            //     'shop_image' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',

            //     // ===== Security / Password =====
            //     'password' => 'nullable|string|min:8|confirmed', // only if updating password
        ];
    }

    public function messages(): array
    {
        return [
            'business_name.required'  => 'Business name is required.',
            'business_phone.required' => 'Primary business phone is required.',
            // 'account_number.required' => 'Bank account number is required.',
            // 'address.required' => 'Address is required.',
            // 'city.required' => 'City is required.',
            // 'province.required' => 'Province is required.',
            // 'password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
