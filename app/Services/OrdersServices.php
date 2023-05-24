<?php

namespace App\Services;

use App\Events\AuditEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Interfaces\OrdersServicesInterface;
use App\Interfaces\ProductServiceInterface;
use App\Interfaces\OrdersRepositoryInterface;

class OrdersServices implements OrdersServicesInterface
{

    protected OrdersRepositoryInterface $ordersRepository;
    protected ProductServiceInterface $productServices;
    public function __construct(
        OrdersRepositoryInterface $ordersRepository,
        ProductServiceInterface $productServices
    ) {
        $this->ordersRepository = $ordersRepository;
        $this->productServices = $productServices;
    }

    public function store($orderDetails, $totalPrice, $userId)
    {
        $address = $this->extractAddress($orderDetails);
        $order = [
            'address' => $address,
            'user_id' => $userId,
            'total_price' => $totalPrice,
            'payment_method' => $orderDetails['payment_method'],
            'money_received' => $orderDetails['money_received']
        ];

        $order = $this->ordersRepository->create($order);
        
        event(new AuditEvent($order, 'create', null));

        return $order;
    }

    private function extractAddress($details)
    {
        $address = $details['street'] . ', ' . $details['city'] . ', ' . $details['state'];

        return $address;
    }
    public function isPaymentSuccessful($totalPrice, $receivedMoney)
    {
        $epsilon = 0.0001; // Adjust the tolerance level as needed

        return abs($totalPrice - $receivedMoney) < $epsilon;
    }

    public function quantityInStock($productsToValidate)
    {
        $outOfStockProducts = [];

        foreach ($productsToValidate as $productToValidate) {

            $product = $this->productServices->getProductById($productToValidate['product_id']);

            if (!$product || $productToValidate['desired_quantity'] > $product->stock) {
                array_push($outOfStockProducts, ["id" => $productToValidate['id'], "stock" => $product->stock]);
            }
        }
        return  count($outOfStockProducts) ? $outOfStockProducts : true;
    }

    public function getUserOrderHistory()
    {
        $userId = Auth::user()->id;
        $cacheKey = 'user_order_history_' . $userId;
        $seconds = 60;
        $orders = Cache::remember($cacheKey, $seconds, function () use ($userId) {
            if (Auth::user()->isAdmin()) {
                return $this->ordersRepository->getAllOrders();
            } else {
                return $this->ordersRepository->getUserOrders($userId);
            }
        });

        return $orders;
    }

    public function getAllOrderDetails($id)
    {
        return $this->ordersRepository->getOrdersDetails($id);
    }
}
