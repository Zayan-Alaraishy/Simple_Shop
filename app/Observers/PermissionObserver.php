<?php

namespace App\Observers;

use App\Models\Permission;
use Illuminate\Support\Facades\Log;

class PermissionObserver
{
    /**
     * Handle the Permission "created" event.
     */
    public function created(Permission $permission): void
    {
        if (auth()->check()) {
            Log::channel('info')->info('New Permission #' . $permission->id . ' is created by user: ' . auth()->user()->username);
        }
    }

    /**
     * Handle the Permission "updated" event.
     */
    public function updated(Permission $permission): void
    {
        //
    }

    /**
     * Handle the Permission "deleted" event.
     */
    public function deleted(Permission $permission): void
    {
        //
    }

    /**
     * Handle the Permission "restored" event.
     */
    public function restored(Permission $permission): void
    {
        //
    }

    /**
     * Handle the Permission "force deleted" event.
     */
    public function forceDeleted(Permission $permission): void
    {
        //
    }
}