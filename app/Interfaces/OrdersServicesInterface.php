<?php

namespace App\Interfaces;

interface OrdersServicesInterface
{

    public function store(array $details, $totalPrice, $userId);
    public function isPaymentSuccessful($totalPrice, $moneyReceived);

    public function quantityInStock($productsToValidate);
    public function getAllOrderDetails($orderId);
    public function getUserOrderHistory();

    public function filterOrders (array $filters) ;
}
