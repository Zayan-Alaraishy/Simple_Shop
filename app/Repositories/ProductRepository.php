<?php
namespace App\Repositories;

use App\Models\Product;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var Product
     */
    protected $product;

    /**
     * ProductRepository constructor.
     *
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getById($id)
    {
        $product = new $this->product;
        return $product->findOrFail($id);
    }

    public function save($details)
    {
        return Product::create($details);
    }

    public function update($id, $new_details)
    {
        $product = Product::find($id);

        if (!$product) {
            return null;
        }

        $product->update($new_details);

        return $product;
    }

    public function delete($id)
    {
        $product = $this->product->find($id);
        $product->delete();
    }

    public function getProducts($category = null, $name = null, $sortBy = null, $perPage = 10)
    {
        $query = Product::query();
        if (!(Auth::check() && Auth::user()->isAdmin())) {
            $query->where('visibility', 1);
        }

        // if ($category !== null) {
        //     $query->where('category_id', $category);
        // }

        if ($category !== null) {
            $query->whereHas('category', function ($query) use ($category) {
                $query->where('name', $category);
            });
        }


        if ($name !== null) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }

        if ($sortBy !== null) {
            $query->orderBy($sortBy);
        }

        return $query->simplePaginate($perPage);
    }
    public function updateAverageRating(int $productId): void
    {
        $product = Product::find($productId);
        $averageRating = round(Rating::where('product_id', $productId)->avg('rating'));
        $product->average_rating = $averageRating;
        $product->save();
    }

}