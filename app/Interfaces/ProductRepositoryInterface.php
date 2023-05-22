<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function getById($id);
    public function save(array $details);
    public function update($id, array $new_details);
    public function delete($id);
    public function getProducts($query, $perPage);

    public function updateAverageRating($productId) ;

    public function updateStock ($productId, $quantity) ;

}
