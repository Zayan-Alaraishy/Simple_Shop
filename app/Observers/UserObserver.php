<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        Log::channel('info')->info('New user '. $user->username . 'is registered');
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        Log::channel('info')->info('User '. $user->username . 'has updated the profile');
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        Log::channel('info')->info('User '. $user->username . 'has been deleted');
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
