<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /** @return array<string,string> */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user()->id,
            'image' => ['image', 'mimes:jpeg,png,jpg', 'max:2048', Rule::dimensions()
                ->minWidth(200)->minHeight(200)
                ->minRatio(1.05)->maxRatio(0.95),
            ],
        ];
    }
}
