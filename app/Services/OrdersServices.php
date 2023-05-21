<?php

namespace App\Services;

use App\Interfaces\OrdersRepositoryInterface;
use App\Interfaces\OrdersServicesInterface;
use Illuminate\Support\Facades\Auth;

class OrdersServices implements OrdersServicesInterface
{

    protected OrdersRepositoryInterface $OrdersRepository;
    public function __construct(OrdersRepositoryInterface $OrdersRepository)
    {
        $this->OrdersRepository = $OrdersRepository;
    }

    public function store($details)
    {
        $address = $this->extractAddress($details);
        $details['address'] = $address;
        // This just an example, until Yazeed finished
        $details['total_price'] = 55;
        $details['user_id'] = Auth::user()->id;

        $order = $this->OrdersRepository->create($details);
        return $order;
    }

    private function extractAddress($details)
    {
        $street = $details['street'];
        $city = $details['city'];
        $state = $details['state'];

        $address = $street . ', ' . $city . ', ' . $state;

        return $address;
    }
    function isPaymentSuccessful($totalPrice, $receivedMoney)
    {
        if ($totalPrice == $receivedMoney) {
            return true;
        } else {
            return false;
        }
    }

}
