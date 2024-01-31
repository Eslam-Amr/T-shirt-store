<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class reviewRequest extends FormRequest
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
            'stars' => 'required',
            'name' => 'required|min:3|max:15',
            'email' => 'required|email',
            'number' => 'required|numeric',
            'message' => 'required|min:5|max:500',
        ];
    }
}
