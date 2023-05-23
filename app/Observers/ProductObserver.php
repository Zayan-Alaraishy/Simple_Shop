<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        if (auth()->check()) {
            Log::channel('info')->info('New product named ' . $product->name . ' is created by user: ' . auth()->user()->username);
        }
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        Log::channel('info')->info('Product named ' . $product->name . ' is updated by user: ' . auth()->user()->username);

    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        Log::channel('info')->info('Product named ' . $product->name . ' is deleted by user: ' . auth()->user()->username);
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}