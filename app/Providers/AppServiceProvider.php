<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Repositories\Contracts\ResourceRepositoryInterface::class, \App\Repositories\ResourceRepository::class);
        $this->app->bind(\App\Repositories\Contracts\BookingRepositoryInterface::class, \App\Repositories\BookingRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
