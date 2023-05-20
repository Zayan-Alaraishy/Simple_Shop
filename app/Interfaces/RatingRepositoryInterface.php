<?php

namespace App\Interfaces;

use App\Models\Rating;
use Illuminate\Support\Collection;

interface RatingRepositoryInterface
{
    public function find(int $id): Rating;
    public function create(array $data): Rating;

    public function update(int $id, array $data): Rating;

    public function delete(int $id): void;

    public function getProductsReviews(int $productId):Collection;
    
}