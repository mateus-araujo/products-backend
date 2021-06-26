<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends BaseRequest
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
            'name' => [
                'string',
                'max:255',
                Rule::unique('products')
                    ->where(
                        function (Builder $query)  {
                            $query->where('id', '!=', $this->route('product')->id);
                        }
                    ),
            ],
            'price' => 'numeric|min:0',
            'quantity' => 'integer|min:0',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'name.unique' => 'There\'s already a product with this name',
            'name.max' => 'Product name exceeds the maximum length',
            'price.numeric' => 'Product price must be numeric',
            'price.min' => 'Product min price is 0',
            'quantity.min' => 'Product min quantity is 0',
            'quantity.integer' => 'Product quantity must be integer',
        ];
    }
}
