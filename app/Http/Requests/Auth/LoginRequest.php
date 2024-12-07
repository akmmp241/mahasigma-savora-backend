<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return !auth()->check();
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', Password::min(8)->max(255)->mixedCase()->numbers()],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new ValidationException($validator);
    }
}
