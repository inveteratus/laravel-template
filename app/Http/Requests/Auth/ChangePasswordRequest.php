<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'current' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
