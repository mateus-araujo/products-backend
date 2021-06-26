<?php

namespace App\Repository\Eloquent;

use App\Models\Product;
use App\Models\User;
use App\Repository\ProductRepositoryInterface;
use Ramsey\Uuid\Uuid;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * Bulk Store of Products
     *
     * @param array $payload
     * @return \Illuminate\Support\Collection $products
     */
    public function bulkStore(array $payload) {
        $collection = collect($payload);

        $products = $collection->map(function ($product) {
            $product = new Product([
                'id' => Uuid::uuid4()->toString(),
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $product['quantity'],
            ]);

            return $product;
        });

        $this->model->insert($products->toArray());

        return $products;
    }

    /**
     * Bulk Update of Products
     *
     * @param array $payload
     * @return \Illuminate\Support\Collection $products
     */
    public function bulkUpdate(array $payload) {
        $collection = collect($payload);

        $products = $collection->map(function ($product) {
            $product = new Product([
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $product['quantity'],
            ]);

            return $product;
        });

        $this->model->upsert(
            $products->toArray(),
            ['id'],
            $this->model->fillable,
        );

        return $products;
    }
}
