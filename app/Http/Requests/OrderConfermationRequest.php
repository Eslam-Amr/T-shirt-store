<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderConfermationRequest extends FormRequest
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
            //
            'firstName' => 'required|min:3|max:15',
            'lastName' => 'required|min:3|max:15',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|min:3|max:100',
            'governorate' => 'required|min:3|max:80',
            'note' => 'nullable|max:900',
            'phone' => 'required|numeric|min_digits:11|max_digits:11',
        ];
    }
}
