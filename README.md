# Harvard Art Museums API for Laravel

A modern Laravel package for interacting with the Harvard Art Museums API.

## Features

- Full Laravel integration with service provider and facade
- PHP 8.1+ with strict types and modern syntax
- Comprehensive error handling with custom exceptions
- Built-in caching support
- Request retry logic
- Type-safe DTOs for API responses
- Full test coverage
- PSR-12 compliant code style

## Requirements

- PHP 8.1 or higher
- Laravel 10.x, 11.x, or 12.x

## Installation

Install the package via Composer:

```bash
composer require harvardartmuseums/laravel-hamapi
```

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --tag=hamapi-config
```

Add your API key to your `.env` file:

```env
HAM_API_KEY=your-api-key-here
```

You can obtain an API key from: https://www.harvardartmuseums.org/collections/api

### Configuration Options

The published config file includes these options:

```php
return [
    'api_key' => env('HAM_API_KEY', ''),
    'base_url' => env('HAM_API_BASE_URL', 'https://api.harvardartmuseums.org'),
    'cache' => [
        'enabled' => env('HAM_API_CACHE_ENABLED', true),
        'ttl' => env('HAM_API_CACHE_TTL', 900), // 15 minutes
        'prefix' => env('HAM_API_CACHE_PREFIX', 'hamapi'),
    ],
    'request' => [
        'timeout' => env('HAM_API_REQUEST_TIMEOUT', 30),
        'retry_times' => env('HAM_API_RETRY_TIMES', 3),
        'retry_delay' => env('HAM_API_RETRY_DELAY', 100),
    ],
    'logging' => [
        'enabled' => env('HAM_API_LOGGING_ENABLED', true),
        'channel' => env('HAM_API_LOG_CHANNEL', 'stack'),
    ],
    'default_params' => [
        'size' => 10,
        'sort' => 'random',
    ],
];
```

## Usage

### Using the Facade

```php
use Harvardartmuseums\HamAPI\Facades\HamApi;

// Get a list of objects
$objects = HamApi::objects(['size' => 10, 'classification' => 'Paintings']);

// Get a single object
$object = HamApi::object(123456);

// Get exhibitions
$exhibitions = HamApi::exhibitions(['status' => 'current']);

// Get a specific exhibition
$exhibition = HamApi::exhibition(789);
```

### Using Dependency Injection

```php
use Harvardartmuseums\HamAPI\Contracts\HamApiClientInterface;

class ArtworkController
{
    public function __construct(
        private HamApiClientInterface $hamApi
    ) {}

    public function index()
    {
        $objects = $this->hamApi->objects([
            'size' => 20,
            'hasimage' => 1,
            'classification' => 'Paintings'
        ]);

        return view('artworks.index', compact('objects'));
    }
}
```

### Available Methods

#### Objects
- `objects(array $params = [])` - Get a list of objects
- `object(int|string $id, array $params = [])` - Get a single object

#### Exhibitions
- `exhibitions(array $params = [])` - Get a list of exhibitions
- `exhibition(int|string $id, array $params = [])` - Get a single exhibition

#### Publications
- `publications(array $params = [])` - Get a list of publications
- `publication(int|string $id, array $params = [])` - Get a single publication

#### People
- `people(array $params = [])` - Get a list of people
- `person(int|string $id, array $params = [])` - Get a single person

#### Galleries
- `galleries(array $params = [])` - Get a list of galleries
- `gallery(int|string $id, array $params = [])` - Get a single gallery

#### Classifications
- `classifications(array $params = [])` - Get a list of classifications
- `classification(int|string $id, array $params = [])` - Get a single classification

#### And many more...

The package supports all endpoints provided by the Harvard Art Museums API, including:
- Periods
- Cultures
- Mediums
- Techniques
- Worktypes
- Places
- Centuries
- Colors
- Spectra
- Groups

### Using DTOs

The package includes Data Transfer Objects for type-safe handling of API responses:

```php
use Harvardartmuseums\HamAPI\DTOs\ApiResponse;
use Harvardartmuseums\HamAPI\DTOs\ArtObject;

// Get objects and wrap in DTO
$response = HamApi::objects(['size' => 10]);
$apiResponse = ApiResponse::fromArray($response);

// Access pagination info
echo $apiResponse->getTotalRecords(); // Total number of records
echo $apiResponse->getCurrentPage();   // Current page number
echo $apiResponse->hasNextPage();      // Check if there's a next page

// Work with individual objects
foreach ($apiResponse->records as $record) {
    $artObject = ArtObject::fromArray($record);

    echo $artObject->getDisplayTitle();
    echo $artObject->getPrimaryArtist();

    if ($artObject->hasImage()) {
        echo $artObject->primaryimageurl;
    }
}
```

### Generic Requests

For endpoints not covered by specific methods, use the generic `get` method:

```php
$response = HamApi::get('custom/endpoint', ['param' => 'value']);
```

## Error Handling

The package provides custom exceptions for better error handling:

```php
use Harvardartmuseums\HamAPI\Exceptions\ApiKeyMissingException;
use Harvardartmuseums\HamAPI\Exceptions\ApiRequestException;

try {
    $objects = HamApi::objects();
} catch (ApiKeyMissingException $e) {
    // Handle missing API key
} catch (ApiRequestException $e) {
    // Handle API request errors
    $statusCode = $e->getStatusCode();
    $responseBody = $e->getResponseBody();
}
```

## Testing

Run the test suite:

```bash
composer test
```

Run tests with coverage:

```bash
composer test-coverage
```

## Code Quality

Format code using Laravel Pint:

```bash
composer format
```

Run static analysis with PHPStan:

```bash
composer analyse
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This package is open-sourced software licensed under the MIT license.

## Support

For API-specific questions, visit: https://www.harvardartmuseums.org/collections/api

For package issues, please use the GitHub issue tracker. 
