<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class DeleteAccountRequest extends FormRequest
{
    /** @return array<string,string> */
    public function rules(): array
    {
        return [
            'password' => 'required|current_password',
        ];
    }
}
