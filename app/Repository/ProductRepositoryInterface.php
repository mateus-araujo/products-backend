<?php

namespace App\Repository;

interface ProductRepositoryInterface extends EloquentRepositoryInterface {
    /**
     * Get Product history
     *
     * @param string $productId
     * @return \Illuminate\Support\Collection $products
     */
    public function history(string $productId);

    /**
     * Bulk Store of Products
     *
     * @param array $payload
     * @return \Illuminate\Support\Collection $products
     */
    public function bulkStore(array $payload);

    /**
     * Bulk Update of Products
     *
     * @param array $payload
     * @return \Illuminate\Support\Collection $products
     */
    public function bulkUpdate(array $payload);
}
