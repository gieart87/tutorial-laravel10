<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'sku' => [
                'required',
                'max:100',
                Rule::unique('products')->ignore($this->id),
            ],
            'name' => ['required', 'max:100'],
            'price' => ['required', 'numeric', 'min:1'],
            'stock' => ['required', 'numeric', 'min:0'],
			'brand_id' => ['required'],
            'category_ids' => ['required', 'array', 'min:2']
        ];
    }
}
