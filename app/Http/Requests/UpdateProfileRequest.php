<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class UpdateProfileRequest extends FormRequest
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
        $user = Auth::user();

        return [
            'email' => 'email|unique:users,email,' . $user->id,
            'username' => 'string|unique:users,username,' . $user->id,
            'country' => 'nullable|string',
            'city' => 'nullable|string',
            'street' => 'nullable|string',
        ];
    }
}
