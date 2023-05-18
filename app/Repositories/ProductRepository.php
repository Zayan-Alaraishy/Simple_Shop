<?php
namespace App\Repositories;

use App\Models\Product;

use App\Interfaces\IProductRepository;

class ProductRepository implements IProductRepository
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

}