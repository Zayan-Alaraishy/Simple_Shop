<?php
 
namespace App\View\Composers;
 
use Illuminate\View\View;
use App\Repositories\UserRepository;
use App\Interfaces\CartServiceInterface;
 
class CartComposer
{
    /**
     * Create a new profile composer.
     */
    public function __construct(
        protected CartServiceInterface $cartService,
    ) {}
 
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        if(auth()->user()){
            $view->with('cartItems', $this->cartService->getUserCartItems(auth()->user()->id));
            $view->with('cartTotal', $this->cartService->calculateCartTotal(auth()->user()->id));
        }
    }
}