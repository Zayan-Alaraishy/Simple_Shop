<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->realText(180),
            'category_id' =>  rand(1, 10),
            'unit_price' => $this->faker->randomFloat(2, 0, 100),
            'visibility' => $this->faker->boolean(),
            'average_rating' => null,
            'stock' => $this->faker->numberBetween(0, 100),
            'images' => [],
        ];
    }
}