<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAddressRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'label' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'street' => 'required|string|max:255',
            'building' => 'nullable|string|max:50',
            'floor' => 'nullable|string|max:50',
            'apartment' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
            'is_default' => 'nullable|boolean',
        ];
    }
}
