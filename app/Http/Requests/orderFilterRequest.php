<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class orderFilterRequest extends FormRequest
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
            "sort_by" => "string|in:total_price, created_at else|nullable",
            "start_date" => "nullable|date|before:end_date",
            "end_date" => "nullable|date|before_or_equal:today",


        ];
    }
}
