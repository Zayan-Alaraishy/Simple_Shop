<?php

namespace App\Interfaces;

interface OrdersServicesInterface
{

    public function store(array $details);
    public function isPaymentSuccessful($totalPrice, $receivedMoney) ; 

}
