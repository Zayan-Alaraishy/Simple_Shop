<?php

namespace App\Interfaces;
use App\Models\Rating;

interface RatingServiceInterface
{
    public function createRating(array $data, int $currentUser): Rating;

    public function updateRating(int $ratingId,array $data, int $currentUser): Rating;

    public function deleteRating(int $ratingId, int $currentUser): void;

}