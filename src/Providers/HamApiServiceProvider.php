<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Providers;

use Harvardartmuseums\HamAPI\Contracts\HamApiClientInterface;
use Harvardartmuseums\HamAPI\Facades\HamApi as HamApiFacade;
use Harvardartmuseums\HamAPI\Services\BrowseService;
use Harvardartmuseums\HamAPI\Services\Builders\ExhibitionQueryBuilder;
use Harvardartmuseums\HamAPI\Services\Builders\ObjectQueryBuilder;
use Harvardartmuseums\HamAPI\Services\Builders\PersonQueryBuilder;
use Harvardartmuseums\HamAPI\Services\Builders\PublicationQueryBuilder;
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

        // Register BrowseService
        $this->app->singleton(BrowseService::class, function ($app) {
            return new BrowseService(
                $app->make(HamApiClientInterface::class)
            );
        });

        // Register Query Builders
        $this->app->bind(ObjectQueryBuilder::class, function ($app) {
            return new ObjectQueryBuilder(
                $app->make(HamApiClientInterface::class)
            );
        });

        $this->app->bind(PersonQueryBuilder::class, function ($app) {
            return new PersonQueryBuilder(
                $app->make(HamApiClientInterface::class)
            );
        });

        $this->app->bind(ExhibitionQueryBuilder::class, function ($app) {
            return new ExhibitionQueryBuilder(
                $app->make(HamApiClientInterface::class)
            );
        });

        $this->app->bind(PublicationQueryBuilder::class, function ($app) {
            return new PublicationQueryBuilder(
                $app->make(HamApiClientInterface::class)
            );
        });

        // Register aliases for easy access
        $this->app->alias(BrowseService::class, 'hamapi.browse');
        $this->app->alias(ObjectQueryBuilder::class, 'hamapi.objects');
        $this->app->alias(PersonQueryBuilder::class, 'hamapi.people');
        $this->app->alias(ExhibitionQueryBuilder::class, 'hamapi.exhibitions');
        $this->app->alias(PublicationQueryBuilder::class, 'hamapi.publications');
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
            BrowseService::class,
            'hamapi.browse',
            ObjectQueryBuilder::class,
            'hamapi.objects',
            PersonQueryBuilder::class,
            'hamapi.people',
            ExhibitionQueryBuilder::class,
            'hamapi.exhibitions',
            PublicationQueryBuilder::class,
            'hamapi.publications',
        ];
    }
}
