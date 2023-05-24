<?php

namespace App\Providers;

use App\Services\CartService;
use App\Services\AuthServices;
use App\Services\RolesServices;
use App\Services\OrdersServices;
use App\Services\ProductService;
use App\Services\ProfileService;
use App\Services\OrderItemServices;
use App\Services\AuditLogService;
use App\Repositories\AuthRepository;
use App\Repositories\CartRepository;
use App\Repositories\UserRepository;
use App\Repositories\RolesRepository;
use App\Services\PermissionsServices;
use App\Repositories\OrdersRepository;
use App\Services\PasswordResetService;
use App\Repositories\ProfileRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\AuthServiceInterface;
use App\Interfaces\CartServiceInterface;
use App\Repositories\AuditLogRepository;
use App\Repositories\OrderItemRepository;
use App\Interfaces\RolesServicesInterface;
use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\CartRepositoryInterface;
use App\Interfaces\OrdersServicesInterface;
use App\Interfaces\ProductServiceInterface;
use App\Interfaces\ProfileServiceInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\PermissionsRepository;
use App\Interfaces\RolesRepositoryInterface;
use App\Interfaces\AuditLogServiceInterface;
use App\Interfaces\OrdersRepositoryInterface;
use App\Interfaces\OrderItemServicesInterface;
use App\Interfaces\ProfileRepositoryInterface;
use App\Interfaces\AuditLogRepositoryInterface;
use App\Interfaces\OrderItemRepositoryInterface;
use App\Interfaces\PermissionsServicesInterface;
use App\Interfaces\PasswordResetServiceInterface;
use App\Interfaces\PermissionsRepositoryInterface;

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
        $this->app->bind(OrdersRepositoryInterface::class, OrdersRepository::class);
        $this->app->bind(OrdersServicesInterface::class, OrdersServices::class);
        $this->app->bind(CartServiceInterface::class, CartService::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(OrderItemRepositoryInterface::class, OrderItemRepository::class);
        $this->app->bind(OrderItemServicesInterface::class, OrderItemServices::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RolesServicesInterface::class, RolesServices::class);
        $this->app->bind(RolesRepositoryInterface::class, RolesRepository::class);
        $this->app->bind(PermissionsServicesInterface::class, PermissionsServices::class);
        $this->app->bind(PermissionsRepositoryInterface::class, PermissionsRepository::class);
        $this->app->bind(AuditLogRepositoryInterface::class, AuditLogRepository::class);
        $this->app->bind(AuditLogServiceInterface::class, AuditLogService::class);


    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Paginator::useBootstrap();
    }
}