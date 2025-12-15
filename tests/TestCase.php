<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Tests;

use Harvardartmuseums\HamAPI\Providers\HamApiServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array<int, class-string<\Illuminate\Support\ServiceProvider>>
     */
    protected function getPackageProviders($app): array
    {
        return [
            HamApiServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function defineEnvironment($app): void
    {
        // Setup default configuration
        $app['config']->set('hamapi.api_key', 'test-api-key');
        $app['config']->set('hamapi.base_url', 'https://api.harvardartmuseums.org');
        $app['config']->set('hamapi.cache.enabled', false);
        $app['config']->set('hamapi.logging.enabled', false);
    }
}