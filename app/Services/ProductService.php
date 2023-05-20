<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Interfaces\ProductServiceInterface;

class ProductService implements ProductServiceInterface
{

    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function saveProduct($details)
    {
        $imagesPath = $this->handleUploadedImages($details['images']);

        $details['images'] =  $imagesPath;

        return $this->productRepository->save($details);
    }
    public function getProductById($id)
    {
        return $this->productRepository->getById($id);
    }
    public function updateProductById($id, $new_details)
    {

        return $this->productRepository->update($id, $new_details);
    }
    public function deleteProductById($id)
    {
        $this->productRepository->delete($id);
    }

    public function handleUploadedImages($images)
    {
        $imagePaths = [];

        if ($images) {
            foreach ($images as $image) {
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

                $image->storeAs('public/images', $imageName);
                $imagePaths[] = 'images/' . $imageName;
            }
        }

        return $imagePaths;
    }

    public function getProducts($category = null, $name = null, $sortBy = null, $perPage = 10)
    {
        return $this->productRepository->getProducts($category, $name, $sortBy, $perPage);
    }

    public function updateProductAverageRating(int $productId): void
    {
        $this->productRepository->updateAverageRating($productId);
    }

}
