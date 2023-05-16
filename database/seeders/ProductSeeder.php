<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Product::factory()->count(30)->create()->each(function ($product) {
            $images = [
                'https://example.com/image1.jpg',
                'https://example.com/image2.jpg',
                'https://example.com/image3.jpg',
                'https://example.com/image4.jpg',
            ];
            shuffle($images); // Randomize the order of images
            $product->images = array_slice($images, 0, 4); // Keep only the first 4 images
            $product->save();
        });

    }
}