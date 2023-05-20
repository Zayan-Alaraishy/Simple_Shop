<?php

namespace App\Services;

use App\Repositories\CartRepository;
use App\Interfaces\CartServiceInterface;
use App\Repositories\ProductRepository;

class CartService implements CartServiceInterface
{

    public function __construct(
        protected CartRepository $cartRepository, 
        protected ProductRepository $productRepository){}
        
    public function getById($id)
    {
        return $this->cartRepository->getById($id);
    }

    public function create($userId, $productId, $desired_quantity)
    {
        $cartItem = $this->cartRepository->getByUserAndProduct($userId, $productId);
        
        // If exists, update it
        if($cartItem){
            return $this->update($cartItem->id, $desired_quantity);
        }

        // Create cart item
        $product = $this->productRepository->getById($productId);

        return $this->cartRepository->create([
            'user_id' => $userId,
            'product_id' => $productId,
            'desired_quantity' => $desired_quantity,
            'unit_price' => $product->unit_price
        ]);
    }

    public function update($id, $desiredQuantity)
    {
        return $this->cartRepository->update($id, $desiredQuantity);
    }

    public function delete($id)
    {
        $this->cartRepository->delete($id);
    }


    public function getUserCartItems($userId)
    {
        return $this->cartRepository->getUserCartItems($userId);
    }

    public function calculateCartTotal($userId)
    {
        $cartTotal = 0;
        $this->cartRepository->getUserCartItems($userId)->each(function ($cartItem) use (&$cartTotal){
            $cartTotal += $cartItem->unit_price * $cartItem->desired_quantity;
        });

        return $cartTotal;
    }
}
