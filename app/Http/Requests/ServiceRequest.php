<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'category_id' => ['required', 'exists:service_categories,id'],
            'icon' => ['nullable', 'image', 'max:2048'],
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string', 'max:500'],
            'long_description' => ['required', 'string'],
            'is_featured' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'The category is required.',
            'category_id.exists' => 'The selected category is invalid.',
            'icon.image' => 'The icon must be an image.',
            'icon.mimes' => 'The icon must be a file of type: jpeg, png, jpg, gif.',
            'title.required' => 'The title is required.',
            'short_description.required' => 'The short description is required.',
            'long_description.required' => 'The long description is required.',
        ];
    }
}
