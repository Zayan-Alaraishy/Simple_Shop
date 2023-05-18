<?php

namespace App\Interfaces;

interface ProductServiceInterface
{
    public function saveProduct($details);
    public function getProductById($id);
    public function updateProductById($id, $new_details);
    public function deleteProductById($id);
}