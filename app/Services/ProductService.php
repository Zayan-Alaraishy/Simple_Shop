<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Interfaces\ProductServiceInterface;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
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

    public function getProducts($category = null, $name = null, $sortBy = null, $perPage = 10)
    {
        $query = Product::query();
        if (!(Auth::check() && Auth::user()->isAdmin())) {
            $query->where('visibility', 1);
        }

        if ($category !== null) {
            $query->whereHas('category', function ($query) use ($category) {
                $query->where('name', $category);
            });
        }


        if ($name !== null) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }

        if ($sortBy !== null) {
            $query->orderBy($sortBy);
        }

        return $this->productRepository->getProducts($query, $perPage);
    }

    public function updateProductAverageRating(int $productId): void
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
