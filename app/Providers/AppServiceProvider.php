<?php

namespace App\Providers;

use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\AuthServiceInterface;
use App\Interfaces\CartRepositoryInterface;
use App\Interfaces\CartServiceInterface;
use App\Interfaces\PasswordResetServiceInterface;
use App\Interfaces\ProfileRepositoryInterface;
use App\Interfaces\ProfileServiceInterface;
use App\Repositories\AuthRepository;
use App\Repositories\CartRepository;
use App\Repositories\ProfileRepository;
use App\Services\AuthServices;
use App\Services\CartService;
use App\Services\PasswordResetService;
use App\Services\ProfileService;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(CartServiceInterface::class, CartService::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Paginator::useBootstrap();
    }
}
