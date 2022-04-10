<?php

namespace App\Providers;

use App\Services\ModelStatsService;
use Illuminate\Support\ServiceProvider;

/**
 * Class ModelStatsServiceProvider
 * Inject the model stats service provider
 * @package App\Providers
 */
class ModelStatsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ModelStatsService::class, fn() => new ModelStatsService());
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
