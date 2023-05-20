<?php

namespace App\Interfaces;

interface CartServiceInterface
{
    public function getById($id);
    public function create($userId, $productId, $desiredQuantity);
    public function update($id, $quantity);
    public function delete($id);
    public function getUserCartItems($userId);
    public function calculateCartTotal($userId);
    public function bulkUpdate(array $cartItems);
}