<?php
namespace App\Interfaces;


interface OrdersRepositoryInterface
{
    public function create(array $details);
    public function getOrdersDetails($id);

    public function getUserOrders($id) ;
    public function getAllOrders() ;

}
