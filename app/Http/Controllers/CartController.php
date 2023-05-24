<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;

class CartController extends Controller
{
    public function __construct(protected CartService $cartService) { }

    public function index()
    {
        $userId = auth()->user()->id;
        $cartItems = $this->cartService->getUserCartItems($userId);
        $cartTotal = $this->cartService->calculateCartTotal($userId);
        $user = auth()->user();

        return view('cart', compact('cartItems', 'cartTotal', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        try {
            $validated = $request->validated();
            $userId = auth()->user()->id;
            $productId = $validated['product_id'];
            $desiredQuantity = $validated['desired_quantity'];

            $this->cartService->create($userId, $productId, $desiredQuantity);

            return redirect(route('carts.index'))
                ->with('status', ' Product added to the cart');

        } catch (\Exception $e) {
            Log::channel('error')->error('Error when adding a product #'.
                $productId . 'to the cart by user: ' . auth()->user()->username . '\n' . $e);

            return redirect(route('carts.index'))
                ->with('error', 'Failed to add the product to the cart');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        $this->authorize('update', $cart);

        try {
            $validated = $request->validated();
            $desiredQuantity = $validated['desired_quantity'];

            $this->cartService->update($cart->id, $desiredQuantity);

            return redirect(route('carts.index'))
                ->with('status', 'Product item updated successfully');

        } catch (\Exception $e) {
            Log::channel('error')->error('Error when updating cart item # ' . $cart->id .' by user: ' . auth()->user()->username . '\n' . $e);

            return redirect(route('carts.index'))
                ->with('error', 'Failed to update the product in cart');
        }
    }

    public function bulkUpdate(UpdateCartRequest $request)
    {
        Gate::authorize('bulk-update', $request);

        try {
            $cartItems = $request->input('cartitems');
            $this->cartService->bulkUpdate($cartItems);
            return redirect(route('carts.index'))
                ->with('status', 'Cart updated successfully');

        } catch (\Exception $e) {
            Log::channel('error')->error('Error when updating cart by user ' . auth()->user()->username . '\n' . $e);

            return redirect(route('carts.index'))
                ->with('error', 'Failed to update cart');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $this->authorize('delete', $cart);

        try {
           $this->cartService->delete($cart->id);

            return redirect(route('carts.index'))
            ->with('status', 'Product item deleted successfully');
        } catch (\Exception $e) {
            Log::channel('error')->error('Error when deleting cart item #' . $cart->id . '\n' . $e);

            return redirect(route('carts.index'))
                ->with('error', 'Failed to delete the product from the car');
        }
    }
}
