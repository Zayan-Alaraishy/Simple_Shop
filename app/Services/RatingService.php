<?php
namespace App\Services;

use App\Interfaces\RatingServiceInterface;
use App\Models\Rating;
use App\Repositories\RatingRepository;
use App\Services\ProductService;
use Illuminate\Support\Collection;
use Exception;


class RatingService implements RatingServiceInterface 
{
    protected $ratingRepository;
    protected $productService;

    public function __construct(RatingRepository $ratingRepository, ProductService $productService)
    {
        $this->ratingRepository = $ratingRepository;
        $this->productService = $productService;
    }

    
    public function createRating(array $data): Rating
    {
        $rating =  $this->ratingRepository->create($data);
        $this->productService->updateProductAverageRating($rating->product_id);
        return $rating;
    }

    public function updateRating(int $ratingId, array $data): Rating
    {
        return $this->ratingRepository->update($ratingId, $data);
    }

    public function deleteRating($ratingId): void
    {
        $this->ratingRepository->delete($ratingId);
    }
    public function getProductsReviews($productId):Collection
    {
        return $this->ratingRepository->getProductsReviews($productId);
    }
}