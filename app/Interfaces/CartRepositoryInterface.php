<?php

namespace App\Interfaces;

interface CartRepositoryInterface
{
    public function getById($id);
    public function getByUserAndProduct($userId, $productId);
    public function create(array $item);
    public function update($id, array $newItem);
    public function delete($id);
    public function getUserCartItems($userId);
}