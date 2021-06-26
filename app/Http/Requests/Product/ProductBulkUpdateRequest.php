<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;
use App\Models\Product;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;

class ProductBulkUpdateRequest extends BaseRequest
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
            'products.*.id' => 'required|string',
            'products.*.name' => [
                'string',
                'max:255',
                Rule::unique('products')
                    ->where(
                        function (Builder $query)  {
                            $query->where('id', '!=', $this->route('product')->id);
                        }
                    ),
            ],
            'products.*.price' => 'numeric|min:0',
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
            'products.*.id.required' => 'Product id is required',
            'products.*.name.unique' => 'There\'s already a product with this name',
            'products.*.name.max' => 'Product name exceeds the maximum length',
            'products.*.price.numeric' => 'Product price must be numeric',
            'products.*.price.min' => 'Product min price is 0',
            'products.*.quantity.min' => 'Product min quantity is 0',
            'products.*.quantity.integer' => 'Product quantity must be integer',
        ];
    }
}
