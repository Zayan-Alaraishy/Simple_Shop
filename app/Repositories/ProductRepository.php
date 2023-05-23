<?php

namespace App\Repositories;

use App\Models\Product;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Rating;



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
    public function query()
    {
        return Product::query();
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

    public function getProducts($query, $perPage)
    {

        return $query->simplePaginate($perPage);
    }
    public function updateAverageRating($productId)
    {
        $product = Product::find($productId);
        $averageRating = round(Rating::where('product_id', $productId)->avg('rating'));
        $product->average_rating = $averageRating;
        $product->save();
    }

    public function updateStock($productId, $quantity)
    {
        $product = Product::find($productId);

        $product->stock -= $quantity;

        $product->save();
    }
}
