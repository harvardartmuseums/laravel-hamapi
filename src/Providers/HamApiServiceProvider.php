<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Providers;

use Harvardartmuseums\HamAPI\Contracts\HamApiClientInterface;
use Harvardartmuseums\HamAPI\Facades\HamApi as HamApiFacade;
use Harvardartmuseums\HamAPI\Services\HamApiClient;
use Illuminate\Support\ServiceProvider;

class HamApiServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/hamapi.php',
            'hamapi'
        );

        // Register the main API client as a singleton
        $this->app->singleton(HamApiClientInterface::class, function ($app) {
            return new HamApiClient(
                config('hamapi')
            );
        });

        // Register alias for facade
        $this->app->alias(HamApiClientInterface::class, 'hamapi');
    }

    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/hamapi.php' => config_path('hamapi.php'),
            ], 'hamapi-config');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return [
            HamApiClientInterface::class,
            'hamapi',
        ];
    }
}
