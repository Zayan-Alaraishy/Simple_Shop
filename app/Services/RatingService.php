<?php
namespace App\Services;

use App\Repositories\RatingRepository;


class RatingService
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
}