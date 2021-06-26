<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;

class StoreProductRequest extends BaseRequest
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
            'name' => 'required|unique:products|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'integer|min:0',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required',
            'name.unique' => 'There\'s already a product with this name',
            'name.max' => 'Product name exceeds the maximum length',
            'price.min' => 'Product min price is 0',
            'price.numeric' => 'Product price must be numeric',
            'price.required' => 'Product price is required',
            'quantity.integer' => 'Product quantity must be integer',
            'quantity.min' => 'Product min quantity is 0',
        ];
    }
}
