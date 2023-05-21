<?php

namespace App\Interfaces;

interface CartRepositoryInterface
{
    public function getById($id);
    public function getByUserAndProduct($userId, $productId);
    public function create(array $item);
    public function update($id, array $newItem, bool $isIncrement);
    public function delete($id);

    public function clear($userId);
    public function getUserCartItems($userId);
}
