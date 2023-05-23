<?php

namespace App\Observers;

use App\Models\Role_User;
use Illuminate\Support\Facades\Log;

class RoleUserObserver
{
    /**
     * Handle the Role_User "created" event.
     */
    public function created(Role_User $role_user): void
    {
        Log::channel('info')->info('New user with id # ' . $role_user->user_id . 'assigned to role id # ' . $role_user->role_id . ' by user: ' . auth()->user()->username);
    }

    /**
     * Handle the Role_User "updated" event.
     */
    public function updated(Role_User $role_user): void
    {
        Log::channel('info')->info('User with id # ' . $role_user->user_id . 'updated to be assigned to role id # ' . $role_user->role_id . ' by user: ' . auth()->user()->username);

    }

    /**
     * Handle the Role_User "deleted" event.
     */
    public function deleted(Role_User $role_user): void
    {
        Log::channel('info')->info('Role with id # ' . $role_user->role_id . 'is deleted to user id # ' . $role_user->user_id . ' by user: ' . auth()->user()->username);

    }

    /**
     * Handle the Role_User "restored" event.
     */
    public function restored(Role_User $role_user): void
    {
        //
    }

    /**
     * Handle the Role_User "force deleted" event.
     */
    public function forceDeleted(Role_User $role_user): void
    {
        //
    }
}