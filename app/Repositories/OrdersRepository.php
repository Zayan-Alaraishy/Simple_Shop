<?php

namespace App\Repositories;

use App\Interfaces\OrdersRepositoryInterface;
use App\Models\Order;


class OrdersRepository implements OrdersRepositoryInterface
{

    public function create($details)
    {
        $order = Order::create($details);

        return $order;
    }
}
