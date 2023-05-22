<?php

namespace App\Providers;

use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\AuthServiceInterface;
use App\Interfaces\OrdersServicesInterface;
use App\Interfaces\OrdersRepositoryInterface;
use App\Interfaces\CartRepositoryInterface;
use App\Interfaces\CartServiceInterface;
use App\Interfaces\OrderItemRepositoryInterface;
use App\Interfaces\OrderItemServicesInterface;
use App\Interfaces\PasswordResetServiceInterface;
use App\Interfaces\ProductServiceInterface;
use App\Interfaces\ProfileRepositoryInterface;
use App\Interfaces\ProfileServiceInterface;
use App\Repositories\AuthRepository;
use App\Repositories\CartRepository;
use App\Repositories\OrderItemRepository;
use App\Repositories\ProfileRepository;
use App\Services\AuthServices;
use App\Services\CartService;
use App\Services\PasswordResetService;
use App\Services\ProfileService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\OrdersRepository ;
use App\Services\OrderItemServices;
use App\Services\OrdersServices;
use App\Services\ProductService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthServices::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(ProfileServiceInterface::class, ProfileService::class);
        $this->app->bind(ProfileRepositoryInterface::class, ProfileRepository::class);
        $this->app->bind(PasswordResetServiceInterface::class, PasswordResetService::class);
        $this->app->bind(OrdersRepositoryInterface::class, OrdersRepository::class );
        $this->app->bind(OrdersServicesInterface::class, OrdersServices::class );
        $this->app->bind(CartServiceInterface::class, CartService::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(OrderItemRepositoryInterface::class, OrderItemRepository::class);
        $this->app->bind(OrderItemServicesInterface::class, OrderItemServices::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Paginator::useBootstrap();
    }
}
