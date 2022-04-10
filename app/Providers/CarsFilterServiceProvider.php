<?php

namespace App\Providers;

use App\Services\CarsFilterService;
use Illuminate\Support\ServiceProvider;

/**
 * Class CarsFilterServiceProvider
 * Inject the CarsFilterService into the service provider
 * @package App\Providers
 */
class CarsFilterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(CarsFilterService::class,fn() => new CarsFilterService());
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
