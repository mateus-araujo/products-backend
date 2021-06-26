<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_products()
    {
        $response = $this->get('api/products');

        $response->assertStatus(200)
            ->assertJsonStructure([[
                'id',
                'name',
                'quantity',
                'price',
                'created_at',
                'updated_at',
            ]]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_product()
    {
        $response = $this->post('api/product', [
            'name' => 'Awesome product',
            'price' => 12,
            'quantity' => 1,
        ]);

        $response->assertStatus(201);
    }
}
