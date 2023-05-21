<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Interfaces\OrdersServicesInterface;
use App\Models\Order;

class OrderController extends Controller
{

    protected OrdersServicesInterface $ordersServices;

    public function __construct(OrdersServicesInterface $ordersServices)
    {
        $this->ordersServices = $ordersServices;
    }

    public function create()
    {

        return view('checkout');
    }

    public  function confirm_page($id)
    {

        return view('order_confirmation');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $total_price = $request['total_price'];
        $received_money = $request['received_money'];

        if (!$this->ordersServices->isPaymentSuccessful($total_price, $received_money)) {
            return back()->with('status', 'Please check your payment');
        }

        $order =  $this->ordersServices->store($request->validated());

        return redirect('confirm-order/' . $order->id);

        /**
         * Display the specified resource.
         */
    }
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
