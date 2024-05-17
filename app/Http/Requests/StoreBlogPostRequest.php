<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPostRequest extends FormRequest
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
            'title' => 'required|string|max:250',
            'body' => 'required',            
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories_id' => ['required', 'array', 'min:1'],
            'categories_id.*' => ['required', 'integer', 'exists:categories,id'],
            'published_at' => 'required',   
        ];
    }
}
