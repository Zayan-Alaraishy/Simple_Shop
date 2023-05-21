<?php

namespace App\Providers;

use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\AuthServiceInterface;
use App\Interfaces\OrdersServicesInterface;
use App\Interfaces\OrdersRepositoryInterface;
use App\Interfaces\PasswordResetServiceInterface;
use App\Interfaces\ProfileRepositoryInterface;
use App\Interfaces\ProfileServiceInterface;
use App\Repositories\AuthRepository;
use App\Repositories\ProfileRepository;
use App\Services\AuthServices;
use App\Services\PasswordResetService;
use App\Services\ProfileService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\OrdersRepository ;
use App\Services\OrdersServices;

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

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Paginator::useBootstrap();
    }
}
