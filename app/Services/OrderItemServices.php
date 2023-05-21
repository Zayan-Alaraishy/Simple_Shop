<?php

namespace App\Services;

use App\Interfaces\OrderItemRepositoryInterface;
use App\Interfaces\OrderItemServicesInterface;

class OrderItemServices implements OrderItemServicesInterface
{
    protected OrderItemRepositoryInterface $orderItemRepository;
    public function __construct(OrderItemRepositoryInterface $orderItemRepository)
    {
        $this->orderItemRepository = $orderItemRepository;
    }
    public function store($orderItemDetails, $orderId)
    {

        $modifiedCollection = $orderItemDetails->map(function ($item) use ($orderId) {
            $item->order_id = $orderId;
            $item->quantity = $item->desired_quantity;
            unset($item->user_id);
            unset($item->product);
            unset($item->desired_quantity);

            return $item;
        });
        $this->orderItemRepository->create($modifiedCollection->toArray());
    }
}
