<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeatureRequest extends FormRequest
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
        $featureId = $this->route('feature') ? $this->route('feature') : null; // Get the feature ID if it exists

        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Optional image validation
            'icon' => 'nullable|string|max:100', // Optional icon validation
            'items' => 'nullable|array',
            'items.*' => 'nullable|string|max:255',
        ];

        // If the request method is POST (creating a new feature)
        if ($this->isMethod('post')) {
            $rules['title'] = 'required|unique:features,title|max:255'; // Unique title for creating
        }

        // If the request method is PUT/PATCH (editing an existing feature)
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['title'] = 'required|max:255|unique:features,title,' . $featureId; // Unique title but ignore current feature
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => 'The feature title is required.',
            'title.unique' => 'The feature title must be unique.',
            'description.required' => 'The feature description is required.',
            'image.image' => 'The image must be a valid image file.',
            'items.*.string' => 'Each feature item must be a string.'
        ];
    }
}
