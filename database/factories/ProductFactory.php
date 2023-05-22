<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\File;
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
        $categoriesCount = Category::count();
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->realText(180),
            'category_id' => rand(1, $categoriesCount),
            'unit_price' => $this->faker->randomFloat(2, 0, 100),
            'visibility' => $this->faker->boolean(),
            'average_rating' => rand(1,5),
            'stock' => $this->faker->numberBetween(0, 100),
            'images' => [],
        ];
    }
}