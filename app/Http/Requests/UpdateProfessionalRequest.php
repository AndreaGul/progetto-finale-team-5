<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfessionalRequest extends FormRequest
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
            $rules = [
    'name' => 'required|string|max:30',
    'surname' => 'required|string|max:30',
    'email' => 'required|string|email|max:50|unique:users,email',
    'password' => 'required|string',
    'slug' => 'nullable|string|max:61',
    'curriculum' => 'nullable|string',
    'photo' => 'nullable|string',
    'phone' => 'nullable|string|max:20',
    'performance' => 'nullable|string',
    'address' => 'nullable|string',
];
        ];
    }
}
