<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UpdateCartRequest;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Rating' => 'App\Policies\RatingPolicy',
        
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('bulk-update', function (User $user, UpdateCartRequest $request) {
            $authorized = true;

            $cartItems = $request->input('cartitems');
            foreach($cartItems as $key => $value){
                $cart = Cart::findOrFail($key);

                if($cart->user_id != $user->id){
                    $authorized = false;
                    break;
                }
            }
            return $authorized?
                    Response::allow()
                   :Response::deny('You do not own this cart item');
        });
    }
}
