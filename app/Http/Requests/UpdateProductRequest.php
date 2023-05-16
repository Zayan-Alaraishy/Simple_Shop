<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|max:255',
            'description' => 'string',
            'category_id' => 'exists:categories,id',
            'unit_price' => 'numeric|min:0',
            'visibility' => 'boolean',
            'average_rating' => 'nullable|numeric|min:0|max:5',
            'stock' => 'integer|min:0',
        ];
    }
}