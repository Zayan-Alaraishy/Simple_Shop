<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Interfaces\CartServiceInterface;
use App\Interfaces\OrderItemServicesInterface;
use App\Interfaces\OrdersServicesInterface;
use App\Interfaces\ProductServiceInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    protected OrdersServicesInterface $ordersServices;
    protected CartServiceInterface $cartService;
    protected OrderItemServicesInterface $orderItemServices;

    protected ProductServiceInterface $productServices;
    public function __construct(
        OrdersServicesInterface $ordersServices,
        CartServiceInterface $cartService,
        OrderItemServicesInterface $orderItemServices,
        ProductServiceInterface $productServices,
    ) {
        $this->ordersServices = $ordersServices;
        $this->cartService = $cartService;
        $this->orderItemServices = $orderItemServices;
        $this->productServices = $productServices;
    }



    public function index()
    {
        $orders = $this->ordersServices->getUserOrderHistory();

        return view('orders-history', compact('orders'));
    }

    public function confirm_page($id)
    {
        $orderDetails = $this->ordersServices->getAllOrderDetails($id);
        return view('order_confirmation', compact('orderDetails'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        try {

            $userId = auth()->user()->id;
            $moneyReceived = $request->money_received;
            $cartItems = $this->cartService->getUserCartItems($userId);
            $totalPrice = $this->cartService->calculateCartTotal($userId);

            if ($cartItems->first() == null) {
                return back()->with('emptyCart', 'There are no items in your cart !');
            }

            if (!$this->ordersServices->isPaymentSuccessful($totalPrice, $moneyReceived)) {
                return back()->with('status', 'Please check your payment');
            }

            $productsWithValidQuantity = $this->ordersServices->quantityInStock($cartItems->toArray());
            if (is_array($productsWithValidQuantity)) {
                return back()->with('out_of_stock', $productsWithValidQuantity);
            }

            $orderDetails = $request->validated();

            DB::beginTransaction();

            $order = $this->ordersServices->store($orderDetails, $totalPrice, $userId);

            $this->orderItemServices->store($cartItems, $order->id);
            $this->productServices->updateStockForProduct($cartItems);
            $this->cartService->clear($userId);
            Cache::forget('user_order_history_' . $userId);

            DB::commit();
            return redirect()->route('confirm_order', ['id' => $order->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Operation Failed, try again later');
        }
    }
}