<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Tests\Feature;

use Harvardartmuseums\HamAPI\Contracts\HamApiClientInterface;
use Harvardartmuseums\HamAPI\Facades\HamApi;
use Harvardartmuseums\HamAPI\Services\HamApiClient;
use Harvardartmuseums\HamAPI\Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    public function test_it_registers_service_in_container(): void
    {
        $this->assertInstanceOf(
            HamApiClient::class,
            app(HamApiClientInterface::class)
        );
    }

    public function test_it_registers_alias(): void
    {
        $this->assertInstanceOf(
            HamApiClient::class,
            app('hamapi')
        );
    }

    public function test_facade_works(): void
    {
        $this->assertInstanceOf(
            HamApiClient::class,
            HamApi::getFacadeRoot()
        );
    }

    public function test_it_publishes_config(): void
    {
        $this->artisan('vendor:publish', [
            '--tag' => 'hamapi-config',
        ])->assertExitCode(0);

        $this->assertFileExists(config_path('hamapi.php'));

        // Clean up
        @unlink(config_path('hamapi.php'));
    }

    public function test_config_is_merged(): void
    {
        $config = config('hamapi');

        $this->assertIsArray($config);
        $this->assertArrayHasKey('api_key', $config);
        $this->assertArrayHasKey('base_url', $config);
        $this->assertArrayHasKey('cache', $config);
        $this->assertArrayHasKey('request', $config);
        $this->assertArrayHasKey('logging', $config);
    }

    public function test_service_is_singleton(): void
    {
        $instance1 = app(HamApiClientInterface::class);
        $instance2 = app(HamApiClientInterface::class);

        $this->assertSame($instance1, $instance2);
    }
}