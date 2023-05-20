<?php
namespace App\Repositories;

use App\Interfaces\RatingRepositoryInterface;
use App\Models\Rating;
use Illuminate\Contracts\Pagination\Paginator;

class RatingRepository implements RatingRepositoryInterface
{


    public function find(int $id): Rating
    {
        return Rating::findOrFail($id);
    }
    public function create(array $data): Rating
    {
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
    public function getProductsReviews(int $productId): Paginator
    {
        return Rating::with('user:id,username')
            ->where('product_id', $productId)
            ->simplePaginate(10);
    }

}