<?php

namespace App\Repositories;

use App\Interfaces\OrdersRepositoryInterface;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;


class OrdersRepository implements OrdersRepositoryInterface
{

    public function create($details)
    {
        $order = Order::create($details);

        return $order;
    }

    public function getOrdersDetails($orderId)
    {
        $orders = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('order_items.*', 'orders.*', 'products.*', 'categories.name as category_name')
            ->where('order_items.order_id', $orderId)
            ->get();
        return $orders;
    }


    public function getUserOrders($userId)
    {
        $orders = Order::join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->select('orders.*', DB::raw('SUM(order_items.quantity) as total_quantity'))
            ->where('orders.user_id', $userId)
            ->groupBy('orders.id')
            ->get();

        return $orders;
    }
    public function getAllOrders()
    {
        $orders = Order::join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->select('orders.*', DB::raw('SUM(order_items.quantity) as total_quantity'))
            ->groupBy('orders.id')
            ->get();

        return $orders;
    }
}
