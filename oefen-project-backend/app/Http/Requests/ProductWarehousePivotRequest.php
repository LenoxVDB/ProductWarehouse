<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductWarehousePivotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'stock' => [
                'required',
                'integer',
                'min:1',
            ],
        ];
    }
}
