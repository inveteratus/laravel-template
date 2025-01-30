<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangeImageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['image', 'mimes:jpeg,png,jpg', 'max:2048', Rule::dimensions()
                ->minWidth(200)->minHeight(200)
                ->minRatio(1.05)->maxRatio(0.95),      // 180..220
            ],
        ];
    }
}
