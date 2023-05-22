<?php

namespace App\Repositories;

use App\Interfaces\OrderItemRepositoryInterface;
use App\Models\OrderItem;

class OrderItemRepository implements OrderItemRepositoryInterface
{

    public function create($details)
    {
        $OrderItem = OrderItem::insert($details);

        return $OrderItem;
    }
}
