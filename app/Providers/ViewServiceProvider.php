<?php
 
namespace App\Providers;
 
use Illuminate\View\View;
use Illuminate\Support\Facades;
use App\View\Composers\CartComposer;
use App\View\Composers\ProfileComposer;
use Illuminate\Support\ServiceProvider;
 
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }
 
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Using class based composers...
        Facades\View::composer('*', CartComposer::class);

    }
}