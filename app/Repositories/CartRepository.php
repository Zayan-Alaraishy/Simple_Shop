<?php
namespace App\Repositories;

use App\Models\Cart;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{
    /**
     * @var Cart
     */

    /**
     * ProductRepository constructor.
     *
     * @param Product $product
     */
    public function __construct(protected Cart $cart) {}

    public function getById($id)
    {
        return Cart::findOrFail($id);
    }

    public function getByUserAndProduct($userId, $productId)
    {
        return Cart::where('user_id', $userId)->where('product_id', $productId)->first();
    }

    public function create(array $item)
    {
        // dd($item);
        return Cart::create($item);
    }

    public function update($id, $quantity, bool $isIncrement)
    {
        $cart = $this->getById($id);
        if($isIncrement){
            $cart->increment('desired_quantity', $quantity);
        } else {
            $cart->update(['desired_quantity' => $quantity]);
        }

        return $cart;
    }

    public function delete($id)
    {
        Cart::destroy($id);
    }

    public function getUserCartItems($userId)
    {
        return Cart::where('user_id', $userId)->with('product')->get();
    }

}