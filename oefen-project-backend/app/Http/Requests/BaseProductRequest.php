<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'price' => [
                'required',
                'decimal: 0,2'
            ],
            'summary' => [
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }
}
