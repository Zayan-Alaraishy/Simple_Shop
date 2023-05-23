<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('seeders/json/products.json'));
        $products = json_decode($json);
        
        foreach ($products as $product) {
            $category = Category::firstOrCreate(['name' => $product->category]);
            
            Product::factory()->create([
                'name' => $product->title,
                'unit_price' => $product->price,
                'description' => $product->description,
                'average_rating' => intval($product->rating),
                'stock' => $product->stock,
                'images' => $product->images,
                'category_id' => $category->id,
            ]);
        };

    }
}