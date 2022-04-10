<?php

namespace App\Providers;

use App\Services\UserFilterService;
use Illuminate\Support\ServiceProvider;

/**
 * Class UserFilterServiceProvider
 * Inject the user filter service into the container
 * @package App\Providers
 */
class UserFilterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(UserFilterService::class, fn() => new UserFilterService());
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
