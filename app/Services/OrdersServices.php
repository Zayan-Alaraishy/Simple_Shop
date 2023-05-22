<?php

namespace App\Services;

use App\Interfaces\OrdersRepositoryInterface;
use App\Interfaces\OrdersServicesInterface;
use App\Interfaces\ProductServiceInterface;
use Illuminate\Support\Facades\Auth;

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
        $orders = null;
        if (Auth::user()->isAdmin()) {
            $orders = $this->ordersRepository->getAllOrders();

        } else {
            $orders =  $this->ordersRepository->getUserOrders($userId);
        }
        return $orders;
    }


    public function getAllOrderDetails($id)
    {
        return $this->ordersRepository->getOrdersDetails($id);
    }
}
