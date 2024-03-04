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

            'name' => 'required|string|max:30',
            'surname' => 'required|string|max:30',
            'slug' => 'nullable|string|max:61|unique',
            'curriculum' => 'nullable|file',
            'photo' => 'nullable|image',
            'phone' => 'nullable|string|max:20',
            'performance' => 'nullable|string',
            'address' => 'nullable|string',
            'specializations' => 'nullable|exists:specializations,id'
        ];
    }
}
