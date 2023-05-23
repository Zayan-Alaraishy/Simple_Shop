<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Interfaces\ProductServiceInterface;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ProductService implements ProductServiceInterface
{

    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function saveProduct($details)
    {
        if (isset($details['images'])) {
            $imagesPath = $this->handleUploadedImages($details['images']);
            $details['images'] = $imagesPath;
        }

        return $this->productRepository->save($details);
    }
    public function getProductById($id)
    {
        return $this->productRepository->getById($id);
    }
    public function updateProductById($id, $new_details)
    {
        if (isset($new_details['images'])) {
            $imagesPath = $this->handleUploadedImages($new_details['images']);
            $new_details['images'] = $imagesPath;
        }
        return $this->productRepository->update($id, $new_details);
    }
    public function deleteProductById($id)
    {
        $this->productRepository->delete($id);
    }

    public function handleUploadedImages($images)
    {
        $imagePaths = [];

        foreach ($images as $image) {
            $imagePath = $image->store('public/images');

            $imagePaths[] = $imagePath;
        }


        return $imagePaths;
    }

    public function getProducts($filters)
    {
        $query = $this->productRepository->query();
        if (!Auth::user()?->isAdmin()) {
            $query->where('visibility', true);
        }
        $cacheKey = 'products:' . serialize($filters);

        // Check if the results are already cached
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        if (isset($filters['name'])) {
            $name = $filters['name'];
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($name) . '%']);
        }

        if (isset($filters['category'])) {
            $category = $filters['category'];
            $query->where('category', $category);
        }

        // Sorting by price (ascending)
        if (isset($filters['sort_by']) && $filters['sort_by'] === 'unit_price') {
            $query->orderBy('unit_price', 'asc');
        }

        if (isset($filters['sort_by']) && $filters['sort_by'] === 'average_rating') {
            $query->orderBy('average_rating', 'asc');
        }

        if (isset($filters['sort_by']) && $filters['sort_by'] === 'name') {
            $query->orderBy('name', 'asc');
        }
        $products = $query->simplePaginate(10);

        Cache::put($cacheKey, $products, 60);

        return $products;
    }

    public function updateProductAverageRating(int $productId)
    {
        $this->productRepository->updateAverageRating($productId);
    }

    public function updateStockForProduct($products)
    {
        foreach ($products as $product) {
            $this->productRepository->updateStock($product->product_id, $product->quantity);
        }
    }
}
