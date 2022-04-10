<?php

namespace App\Providers;

use App\Services\CarRentsFilterService;
use Illuminate\Support\ServiceProvider;

class CarRentsFilterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(CarRentsFilterService::class, fn() => new CarRentsFilterService());
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
    }
}
