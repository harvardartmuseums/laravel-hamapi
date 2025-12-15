<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Tests\Unit;

use Harvardartmuseums\HamAPI\Contracts\HamApiClientInterface;
use Harvardartmuseums\HamAPI\Exceptions\ApiKeyMissingException;
use Harvardartmuseums\HamAPI\Exceptions\ApiRequestException;
use Harvardartmuseums\HamAPI\Services\HamApiClient;
use Harvardartmuseums\HamAPI\Tests\TestCase;
use Illuminate\Support\Facades\Http;

class HamApiClientTest extends TestCase
{
    protected HamApiClientInterface $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = app(HamApiClientInterface::class);
    }

    public function test_it_throws_exception_when_api_key_is_missing(): void
    {
        $this->expectException(ApiKeyMissingException::class);

        new HamApiClient(['api_key' => '']);
    }

    public function test_it_can_fetch_objects(): void
    {
        Http::fake([
            'https://api.harvardartmuseums.org/object*' => Http::response([
                'info' => [
                    'totalrecords' => 2,
                    'pages' => 1,
                    'page' => 1,
                ],
                'records' => [
                    ['id' => 1, 'title' => 'Object 1'],
                    ['id' => 2, 'title' => 'Object 2'],
                ],
            ]),
        ]);

        $response = $this->client->objects(['size' => 2]);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('info', $response);
        $this->assertArrayHasKey('records', $response);
        $this->assertCount(2, $response['records']);
    }

    public function test_it_can_fetch_single_object(): void
    {
        Http::fake([
            'https://api.harvardartmuseums.org/object/1*' => Http::response([
                'id' => 1,
                'title' => 'Test Object',
                'objectnumber' => '1234',
            ]),
        ]);

        $response = $this->client->object(1);

        $this->assertIsArray($response);
        $this->assertEquals(1, $response['id']);
        $this->assertEquals('Test Object', $response['title']);
    }

    public function test_it_throws_exception_on_api_error(): void
    {
        Http::fake([
            'https://api.harvardartmuseums.org/object*' => Http::response(
                ['error' => 'Unauthorized'],
                401
            ),
        ]);

        $this->expectException(ApiRequestException::class);
        $this->expectExceptionCode(401);

        $this->client->objects();
    }

    public function test_it_includes_api_key_in_requests(): void
    {
        Http::fake();

        $this->client->objects();

        Http::assertSent(function ($request) {
            return str_contains($request->url(), 'apikey=test-api-key');
        });
    }

    public function test_it_can_fetch_exhibitions(): void
    {
        Http::fake([
            'https://api.harvardartmuseums.org/exhibition*' => Http::response([
                'info' => ['totalrecords' => 1],
                'records' => [
                    ['id' => 1, 'title' => 'Test Exhibition'],
                ],
            ]),
        ]);

        $response = $this->client->exhibitions();

        $this->assertIsArray($response);
        $this->assertArrayHasKey('records', $response);
    }

    public function test_it_can_fetch_people(): void
    {
        Http::fake([
            'https://api.harvardartmuseums.org/person*' => Http::response([
                'info' => ['totalrecords' => 1],
                'records' => [
                    ['id' => 1, 'name' => 'Test Artist'],
                ],
            ]),
        ]);

        $response = $this->client->people();

        $this->assertIsArray($response);
        $this->assertArrayHasKey('records', $response);
    }

    public function test_it_merges_default_params(): void
    {
        config(['hamapi.default_params' => ['size' => 5, 'sort' => 'random']]);

        Http::fake();

        $this->client->objects(['sort' => 'title']);

        Http::assertSent(function ($request) {
            $url = $request->url();
            return str_contains($url, 'size=5') && str_contains($url, 'sort=title');
        });
    }

    public function test_it_can_make_generic_get_request(): void
    {
        Http::fake([
            'https://api.harvardartmuseums.org/custom/*' => Http::response([
                'data' => 'custom response',
            ]),
        ]);

        $response = $this->client->get('custom/endpoint');

        $this->assertIsArray($response);
        $this->assertEquals('custom response', $response['data']);
    }
}