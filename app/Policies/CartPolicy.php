<?php

namespace App\Policies;

use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CartPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Cart $cart): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Cart $cart): Response
    {
        return $user->id === $cart->user_id?
                Response::allow()
               :Response::deny('You do not own this cart item');
    }


    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Cart $cart): Response
    {
        return $user->id === $cart->user_id?
            Response::allow()
            :Response::deny('You do not own this cart item');

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Cart $cart): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Cart $cart): bool
    {
        //
    }
}
