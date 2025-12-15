<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Services;

use Harvardartmuseums\HamAPI\Contracts\HamApiClientInterface;
use Harvardartmuseums\HamAPI\Exceptions\ApiKeyMissingException;
use Harvardartmuseums\HamAPI\Exceptions\ApiRequestException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HamApiClient implements HamApiClientInterface
{
    private PendingRequest $httpClient;
    private array $config;
    private string $apiKey;
    private string $baseUrl;

    /**
     * Create a new API client instance.
     *
     * @throws ApiKeyMissingException
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->apiKey = $config['api_key'] ?? '';
        $this->baseUrl = rtrim($config['base_url'] ?? 'https://api.harvardartmuseums.org', '/');

        if (empty($this->apiKey)) {
            throw new ApiKeyMissingException();
        }

        $this->initializeHttpClient();
    }

    /**
     * Initialize the HTTP client with default configuration.
     */
    private function initializeHttpClient(): void
    {
        $this->httpClient = Http::baseUrl($this->baseUrl)
            ->timeout($this->config['request']['timeout'] ?? 30)
            ->retry(
                $this->config['request']['retry_times'] ?? 3,
                $this->config['request']['retry_delay'] ?? 100
            )
            ->withHeaders([
                'Accept' => 'application/json',
                'User-Agent' => 'Laravel HAM API Client',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function objects(array $params = []): array
    {
        return $this->getCollection('object', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function object(int|string $id, array $params = []): array
    {
        return $this->getResource('object', $id, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function exhibitions(array $params = []): array
    {
        return $this->getCollection('exhibition', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function exhibition(int|string $id, array $params = []): array
    {
        return $this->getResource('exhibition', $id, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function publications(array $params = []): array
    {
        return $this->getCollection('publication', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function publication(int|string $id, array $params = []): array
    {
        return $this->getResource('publication', $id, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function galleries(array $params = []): array
    {
        return $this->getCollection('gallery', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function gallery(int|string $id, array $params = []): array
    {
        return $this->getResource('gallery', $id, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function people(array $params = []): array
    {
        return $this->getCollection('person', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function person(int|string $id, array $params = []): array
    {
        return $this->getResource('person', $id, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function classifications(array $params = []): array
    {
        return $this->getCollection('classification', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function classification(int|string $id, array $params = []): array
    {
        return $this->getResource('classification', $id, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function periods(array $params = []): array
    {
        return $this->getCollection('period', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function period(int|string $id, array $params = []): array
    {
        return $this->getResource('period', $id, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function cultures(array $params = []): array
    {
        return $this->getCollection('culture', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function culture(int|string $id, array $params = []): array
    {
        return $this->getResource('culture', $id, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function mediums(array $params = []): array
    {
        return $this->getCollection('medium', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function medium(int|string $id, array $params = []): array
    {
        return $this->getResource('medium', $id, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function techniques(array $params = []): array
    {
        return $this->getCollection('technique', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function technique(int|string $id, array $params = []): array
    {
        return $this->getResource('technique', $id, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function worktypes(array $params = []): array
    {
        return $this->getCollection('worktype', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function worktype(int|string $id, array $params = []): array
    {
        return $this->getResource('worktype', $id, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function places(array $params = []): array
    {
        return $this->getCollection('place', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function place(int|string $id, array $params = []): array
    {
        return $this->getResource('place', $id, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function centuries(array $params = []): array
    {
        return $this->getCollection('century', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function century(int|string $id, array $params = []): array
    {
        return $this->getResource('century', $id, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function colors(array $params = []): array
    {
        return $this->getCollection('color', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function color(int|string $id, array $params = []): array
    {
        return $this->getResource('color', $id, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function spectra(array $params = []): array
    {
        return $this->getCollection('spectrum', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function spectrum(int|string $id, array $params = []): array
    {
        return $this->getResource('spectrum', $id, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function groups(array $params = []): array
    {
        return $this->getCollection('group', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function group(int|string $id, array $params = []): array
    {
        return $this->getResource('group', $id, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $endpoint, array $params = []): array
    {
        return $this->makeRequest($endpoint, $params);
    }

    /**
     * Get a collection of resources.
     *
     * @param string $resource
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws ApiRequestException
     */
    private function getCollection(string $resource, array $params = []): array
    {
        $endpoint = $resource;
        $params = array_merge($this->config['default_params'] ?? [], $params);

        return $this->makeRequest($endpoint, $params);
    }

    /**
     * Get a single resource by ID.
     *
     * @param string $resource
     * @param int|string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws ApiRequestException
     */
    private function getResource(string $resource, int|string $id, array $params = []): array
    {
        $endpoint = "{$resource}/{$id}";

        return $this->makeRequest($endpoint, $params);
    }

    /**
     * Make an API request.
     *
     * @param string $endpoint
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws ApiRequestException
     */
    private function makeRequest(string $endpoint, array $params = []): array
    {
        // Always include API key
        $params['apikey'] = $this->apiKey;

        // Generate cache key
        $cacheKey = $this->generateCacheKey($endpoint, $params);

        // Check if caching is enabled
        if ($this->config['cache']['enabled'] ?? true) {
            return Cache::remember(
                $cacheKey,
                $this->config['cache']['ttl'] ?? 900,
                fn() => $this->executeRequest($endpoint, $params)
            );
        }

        return $this->executeRequest($endpoint, $params);
    }

    /**
     * Execute the actual HTTP request.
     *
     * @param string $endpoint
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws ApiRequestException
     */
    private function executeRequest(string $endpoint, array $params): array
    {
        try {
            $this->logRequest($endpoint, $params);

            $response = $this->httpClient->get($endpoint, $params);
            $response->throw();

            $data = $response->json();

            $this->logResponse($endpoint, $response->status(), $data);

            return $data;
        } catch (RequestException $e) {
            $this->logError($endpoint, $e);

            throw new ApiRequestException(
                'HAM API request failed: ' . $e->getMessage(),
                $e->response->status(),
                $e->response->body()
            );
        } catch (\Exception $e) {
            $this->logError($endpoint, $e);

            throw new ApiRequestException(
                'Unexpected error during HAM API request: ' . $e->getMessage(),
                0
            );
        }
    }

    /**
     * Generate a cache key for the request.
     *
     * @param string $endpoint
     * @param array<string, mixed> $params
     * @return string
     */
    private function generateCacheKey(string $endpoint, array $params): string
    {
        $prefix = $this->config['cache']['prefix'] ?? 'hamapi';
        ksort($params);

        return sprintf(
            '%s:%s:%s',
            $prefix,
            $endpoint,
            md5(json_encode($params))
        );
    }

    /**
     * Log the request.
     *
     * @param string $endpoint
     * @param array<string, mixed> $params
     */
    private function logRequest(string $endpoint, array $params): void
    {
        if (!($this->config['logging']['enabled'] ?? true)) {
            return;
        }

        Log::channel($this->config['logging']['channel'] ?? 'stack')
            ->debug('HAM API Request', [
                'endpoint' => $endpoint,
                'params' => $params,
            ]);
    }

    /**
     * Log the response.
     *
     * @param string $endpoint
     * @param int $statusCode
     * @param array<string, mixed> $data
     */
    private function logResponse(string $endpoint, int $statusCode, array $data): void
    {
        if (!($this->config['logging']['enabled'] ?? true)) {
            return;
        }

        Log::channel($this->config['logging']['channel'] ?? 'stack')
            ->debug('HAM API Response', [
                'endpoint' => $endpoint,
                'status_code' => $statusCode,
                'records_count' => $data['info']['totalrecords'] ?? count($data),
            ]);
    }

    /**
     * Log an error.
     *
     * @param string $endpoint
     * @param \Exception $exception
     */
    private function logError(string $endpoint, \Exception $exception): void
    {
        if (!($this->config['logging']['enabled'] ?? true)) {
            return;
        }

        $context = [
            'endpoint' => $endpoint,
            'message' => $exception->getMessage(),
        ];

        if ($exception instanceof RequestException) {
            $context['status_code'] = $exception->response->status();
            $context['response_body'] = $exception->response->body();
        }

        Log::channel($this->config['logging']['channel'] ?? 'stack')
            ->error('HAM API Error', $context);
    }
}