<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['nullable', 'min_digits:11', 'max_digits:11', 'unique:users,phone'],
            'gender' => ['nullable', 'in:male,female,other'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:5120'],
            'birth_date' => ['nullable', 'date', 'before:today'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ];
    }
}