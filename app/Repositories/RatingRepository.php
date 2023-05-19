<?php
namespace App\Repositories;

use App\Interfaces\RatingRepositoryInterface;
use App\Models\Rating;

class RatingRepository implements RatingRepositoryInterface
{
    public function getUserRatingForProduct(int $productId, int $userId):Rating
    {
        return Rating::where('product_id', $productId)
            ->where('user_id', $userId)
            ->first();
    }

    public function find(int $id): Rating{
        return Rating::findOrFail($id);
    }
    public function create(array $data): Rating{
        return Rating::create($data);
    }

    public function update(int $id, array $data): Rating
    {
        $rating = $this->find($id);
        $rating->update($data);

        return $rating;
    }


    public function delete(int $id): void
    {
        $rating = $this->find($id);
        $rating->delete();
    }

}