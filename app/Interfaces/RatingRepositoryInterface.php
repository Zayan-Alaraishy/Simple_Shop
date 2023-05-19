<?php

namespace App\Interfaces;
use App\Models\Rating;

interface RatingRepositoryInterface
{
    public function find(int $id): Rating;
    public function create(array $data): Rating;

    public function update(int $id, array $data): Rating;

    public function delete(int $id): void;

    public function getUserRatingForProduct(int $productId, int $userId):Rating;

    // public function updateAverageRating(Product $product): float;

}