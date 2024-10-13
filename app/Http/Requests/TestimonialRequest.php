<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id', // User must exist
            'comment' => 'required|string|max:1000', // Comment must be a string and no more than 1000 characters
            'status' => 'nullable|in:0,1', // Status can be 0 (Draft) or 1 (Published)
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'The user is required.',
            'user_id.exists' => 'The selected user is invalid.',
            'comment.required' => 'The comment is required.',
            'comment.max' => 'The comment may not be greater than 1000 characters.',
            'status.in' => 'The status must be either Draft or Published.',
        ];
    }
}
