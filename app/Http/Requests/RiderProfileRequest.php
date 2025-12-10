<?php
namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RiderProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'              => ['required', 'string', 'max:255'],
            'phone'             => ['required', 'regex:/^\+?[0-9\s\-]{8,20}$/'],
            'alternative_phone' => ['nullable', 'regex:/^\+?[0-9\s\-]{8,20}$/'],
            'date_of_birth'     => ['nullable', 'date'],
            'gender'            => ['nullable', 'string', 'in:Male,Female,Other'],
            'profile_image'     => ['nullable', 'image'],
            'croppedImage'      => [
                'nullable',
                'regex:/^data:image\/(png|jpg|jpeg);base64,/',
            ],
            'email'             => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }
}

