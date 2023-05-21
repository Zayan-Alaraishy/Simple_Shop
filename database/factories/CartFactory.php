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
        return [
            'product_id' => function () {
                return Product::inRandomOrder()->first()->id;
            },
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'desired_quantity' => $this->faker->numberBetween(1,10),
            'unit_price' => $this->faker->randomFloat(2, 0, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
