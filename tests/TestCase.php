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
        // Load environment variables from .env file if it exists
        $envFile = __DIR__ . '/../.env';
        $envVars = [];
        
        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                // Skip comments
                if (strpos(trim($line), '#') === 0) {
                    continue;
                }
                
                // Parse KEY=VALUE format
                if (strpos($line, '=') !== false) {
                    [$key, $value] = explode('=', $line, 2);
                    $key = trim($key);
                    $value = trim($value);
                    
                    // Remove quotes if present
                    $value = trim($value, '"\'');
                    
                    // Store in array
                    $envVars[$key] = $value;
                    
                    // Set environment variables (environment variables take precedence)
                    if (!isset($_ENV[$key]) && !isset($_SERVER[$key])) {
                        $_ENV[$key] = $value;
                        $_SERVER[$key] = $value;
                        putenv("{$key}={$value}");
                    }
                }
            }
        }

        // Setup default configuration
        // Use environment variable if available, otherwise fall back to test key
        $apiKey = $envVars['HAM_API_KEY'] ?? env('HAM_API_KEY') ?? getenv('HAM_API_KEY') ?: 'test-api-key';
        $baseUrl = $envVars['HAM_API_BASE_URL'] ?? env('HAM_API_BASE_URL') ?? getenv('HAM_API_BASE_URL') ?: 'https://api.harvardartmuseums.org';
        $cacheEnabled = isset($envVars['HAM_API_CACHE_ENABLED']) 
            ? filter_var($envVars['HAM_API_CACHE_ENABLED'], FILTER_VALIDATE_BOOLEAN)
            : (env('HAM_API_CACHE_ENABLED', false));
        $loggingEnabled = isset($envVars['HAM_API_LOGGING_ENABLED'])
            ? filter_var($envVars['HAM_API_LOGGING_ENABLED'], FILTER_VALIDATE_BOOLEAN)
            : (env('HAM_API_LOGGING_ENABLED', false));
        
        $app['config']->set('hamapi.api_key', $apiKey);
        $app['config']->set('hamapi.base_url', $baseUrl);
        $app['config']->set('hamapi.cache.enabled', $cacheEnabled);
        $app['config']->set('hamapi.logging.enabled', $loggingEnabled);
    }
}