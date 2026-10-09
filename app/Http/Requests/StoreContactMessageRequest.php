<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['nullable', 'email', 'max:160'],
            'phone' => ['required', 'string', 'min:10', 'max:30'],
            'services' => ['nullable', 'array', 'max:10'],
            'services.*' => ['string', 'exists:services,slug'],
            'plan' => ['nullable', 'string', 'max:120'],
            'budget' => ['nullable', 'string', 'max:60'],
            'message' => ['nullable', 'string', 'max:3000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Enter your name.',
            'phone.required' => 'Enter your phone or WhatsApp number.',
            'phone.min' => 'Enter a full phone number, like 0300 1234567.',
            'email.email' => 'Enter a valid email address, like name@example.com.',
        ];
    }
}
