<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;

class ProductBulkStoreRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'products' => 'required|array',
            'products.*.name' => 'required|string|unique:products|max:255',
            'products.*.price' => 'required|numeric|min:0',
            'products.*.quantity' => 'integer|min:0',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'products.array' => 'products must be an array',
            'products.*.name.required' => 'Product name is required',
            'products.*.name.unique' => 'There\'s already a product with this name',
            'products.*.name.max' => 'Product name exceeds the maximum length',
            'products.*.price.min' => 'Product min price is 0',
            'products.*.price.numeric' => 'Product price must be numeric',
            'products.*.price.required' => 'Product price is required',
            'products.*.quantity.integer' => 'Product quantity must be integer',
            'products.*.quantity.min' => 'Product min quantity is 0',
        ];
    }
}
