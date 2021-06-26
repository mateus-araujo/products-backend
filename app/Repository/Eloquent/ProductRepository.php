<?php

namespace App\Repository\Eloquent;

use App\Models\Product;
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
     * Get Product history
     *
     * @param string $productId
     * @return \Illuminate\Support\Collection $products
     */
    public function history(string $productId) {
        $product = $this->findById($productId);
        $history = $product->history()->get();

        return $history;
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
            $newProduct = new Product([
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $product['quantity'],
            ]);

            $product = $this->findById($product['id']);

            if ($product->quantity !== $newProduct->quantity) {
                $product->history()->create([
                    'quantity' => $newProduct->quantity,
                ]);
            }

            return $newProduct;
        });

        $this->model->upsert(
            $products->toArray(),
            ['id'],
            $this->model->fillable,
        );

        return $products;
    }
}
