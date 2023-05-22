<?php
namespace App\Interfaces;


interface OrdersRepositoryInterface
{
    public function create(array $details);
    public function getOrdersDetails($id);

}
