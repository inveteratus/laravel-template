<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /** @return array<string,string> */
    public function rules(): array
    {
        return [
            'current' => 'required|current_password',
            'password' => 'required|string|min:8',
        ];
    }
}
