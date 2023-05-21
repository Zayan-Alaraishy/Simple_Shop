<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $product = Product::factory()->make();

        return [
            'product_id' => Product::factory(),
            'user_id' => User::factory(),
            'desired_quantity' =>  rand(1, 10),
            'unit_price' =>  $this->faker->randomFloat(2, 0, 100)
        ];
    }
}
