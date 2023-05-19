<?php
namespace App\Services;

use App\Interfaces\RatingServiceInterface;
use App\Models\Rating;
use App\Repositories\RatingRepository;
use Exception;


class RatingService implements RatingServiceInterface 
{
    protected $ratingRepository;

    public function __construct(RatingRepository $ratingRepository)
    {
        $this->ratingRepository = $ratingRepository;
    }

    public function getUserRatingForProduct($product_id, $user_id)
    {
        return $this->ratingRepository->getUserRatingForProduct($product_id, $user_id);
    }

    public function createRating(array $data, $currentUser): Rating
    {
        if ($data['user_id'] != $currentUser) {
            throw new Exception("You are not authorized to create this rating.");
        }
        $data["user_id"] = $currentUser;
        return $this->ratingRepository->create($data);
    }

    public function updateRating($ratingId, array $data, $currentUser): Rating
    {
        $rating = $this->ratingRepository->find($ratingId);

        if ($rating->user_id != $currentUser) {
            throw new Exception("You are not authorized to update this rating.");
        }


        return $this->ratingRepository->update($ratingId, $data);
    }

    public function deleteRating($ratingId, $currentUser): void
    {
        $rating = $this->ratingRepository->find($ratingId);

        if ($rating->user_id != $currentUser) {
            throw new Exception("You are not authorized to delete this rating.");
        }

        $this->ratingRepository->delete($ratingId);
    }
}