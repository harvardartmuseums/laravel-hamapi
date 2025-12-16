<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Harvard Art Museums API Configuration
    |--------------------------------------------------------------------------
    |
    | This file configures the Harvard Art Museums API integration for Laravel.
    | You can obtain an API key from: https://www.harvardartmuseums.org/collections/api
    |
    */

    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    | Your Harvard Art Museums API key. Store this in your .env file
    | as HAM_API_KEY for security.
    |
    */
    'api_key' => env('HAM_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | API Base URL
    |--------------------------------------------------------------------------
    |
    | The base URL for the Harvard Art Museums API.
    |
    */
    'base_url' => env('HAM_API_BASE_URL', 'https://api.harvardartmuseums.org'),

    // Backward compatibility alias for base_url
    'api_url' => env('HAM_API_BASE_URL', 'https://api.harvardartmuseums.org'),

    /*
    |--------------------------------------------------------------------------
    | Cache Configuration
    |--------------------------------------------------------------------------
    |
    | Configure how API responses should be cached.
    |
    */
    'cache' => [
        'enabled' => env('HAM_API_CACHE_ENABLED', true),
        'ttl' => (int) env('HAM_API_CACHE_TTL', 900), // 15 minutes in seconds
        'prefix' => env('HAM_API_CACHE_PREFIX', 'hamapi'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Request Configuration
    |--------------------------------------------------------------------------
    |
    | Configure request timeouts and retry attempts.
    |
    */
    'request' => [
        'timeout' => (int) env('HAM_API_REQUEST_TIMEOUT', 30),
        'retry_times' => (int) env('HAM_API_RETRY_TIMES', 3),
        'retry_delay' => (int) env('HAM_API_RETRY_DELAY', 100), // milliseconds
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging
    |--------------------------------------------------------------------------
    |
    | Configure API request and response logging.
    |
    */
    'logging' => [
        'enabled' => env('HAM_API_LOGGING_ENABLED', true),
        'channel' => env('HAM_API_LOG_CHANNEL', 'stack'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Parameters
    |--------------------------------------------------------------------------
    |
    | Default parameters that will be included in all API requests.
    |
    */
    'default_params' => [
        'size' => 10,
        'sort' => 'random',
    ],
];