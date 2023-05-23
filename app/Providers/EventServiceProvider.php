<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Role_User;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Observers\PermissionObserver;
use App\Observers\RoleObserver;
use App\Observers\RoleUserObserver;
use App\Observers\UserObserver;
use App\Observers\OrderObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Product::observe(ProductObserver::class);
        Order::observe(OrderObserver::class);
        Permission::observe(PermissionObserver::class);
        Role::observe(RoleObserver::class);
        Role_User::observe(RoleUserObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}