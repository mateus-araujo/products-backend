<?php

namespace App\Observers;

use App\Models\Product;
use Ramsey\Uuid\Uuid;

class ProductObserver
{
    /**
     * Handle the Product "creating" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->id = Uuid::uuid4()->toString();
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        $product->history()->create([
            'quantity' => $product->quantity,
        ]);
    }
}
