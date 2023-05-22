<?php

namespace App\Repositories;

use App\Interfaces\OrdersRepositoryInterface;
use App\Models\Order;
use App\Models\OrderItem;


class OrdersRepository implements OrdersRepositoryInterface
{

    public function create($details)
    {
        $order = Order::create($details);

        return $order;
    }

    public function getOrdersDetails($orderId){
        $orderItems = OrderItem::join('orders', 'orders.id', '=', 'order_items.order_id')
        ->join('products', 'products.id', '=', 'order_items.product_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->select('order_items.*', 'orders.*', 'products.*', 'categories.name as category_name')
        ->where('order_items.order_id', $orderId)
        ->get();
        return $orderItems;
    }
}
