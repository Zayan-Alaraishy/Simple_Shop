<?php

namespace App\Interfaces;
use App\Models\Rating;
use Illuminate\Contracts\Pagination\Paginator;

interface RatingServiceInterface
{
    public function createRating(array $data): Rating;

    public function updateRating(int $ratingId, array $data): Rating;

    public function deleteRating(int $ratingId): void;
    public function getProductsReviews(int $productId): Paginator;
    
}