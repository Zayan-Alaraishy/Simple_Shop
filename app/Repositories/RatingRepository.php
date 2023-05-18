<?php
namespace App\Repositories;

use App\Interfaces\RatingRepositoryInterface;
use App\Models\Rating;

class RatingRepository implements RatingRepositoryInterface
{
    public function getUserRatingForProduct($productId, $userId)
    {
        return Rating::where('product_id', $productId)
            ->where('user_id', $userId)
            ->first();
    }

    public function save(array $details)
    {

    }

    public function update($id, array $new_details)
    {

    }
}