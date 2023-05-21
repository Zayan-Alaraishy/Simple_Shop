<?php
namespace App\Interfaces;
interface OrderItemServicesInterface
{
    public function store($orderItemDetails, $orderId);

}
