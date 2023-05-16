<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{

    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function saveProduct($details)
    {
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


}