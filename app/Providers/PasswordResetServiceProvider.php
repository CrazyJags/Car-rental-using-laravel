<?php

namespace App\Providers;

use App\Services\PasswordResetService;
use Illuminate\Support\ServiceProvider;

/**
 * Class PasswordResetServiceProvider
 * Provide the password reset service through the container for dependency injection.
 * @package App\Providers
 */
class PasswordResetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(PasswordResetService::class, fn($app) => new PasswordResetService());
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
