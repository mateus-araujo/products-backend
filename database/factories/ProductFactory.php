<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => (string) Uuid::uuid4(),
            'name' => $this->faker->words(3, true),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'quantity' => $this->faker->randomNumber(2)
        ];
    }
}
