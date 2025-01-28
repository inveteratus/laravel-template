<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    /** @return array<string,string> */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
        ];
    }
}
