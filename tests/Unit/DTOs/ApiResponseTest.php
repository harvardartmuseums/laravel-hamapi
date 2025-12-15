<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Tests\Unit\DTOs;

use Harvardartmuseums\HamAPI\DTOs\ApiResponse;
use Harvardartmuseums\HamAPI\Tests\TestCase;

class ApiResponseTest extends TestCase
{
    public function test_it_creates_from_array(): void
    {
        $data = [
            'info' => [
                'totalrecords' => 100,
                'pages' => 10,
                'page' => 1,
                'next' => 'https://api.example.com/next',
                'prev' => null,
            ],
            'records' => [
                ['id' => 1],
                ['id' => 2],
            ],
            'aggregations' => [
                'by_year' => ['2020' => 10, '2021' => 20],
            ],
        ];

        $response = ApiResponse::fromArray($data);

        $this->assertEquals(100, $response->getTotalRecords());
        $this->assertEquals(10, $response->getTotalPages());
        $this->assertEquals(1, $response->getCurrentPage());
        $this->assertEquals('https://api.example.com/next', $response->getNextUrl());
        $this->assertNull($response->getPreviousUrl());
        $this->assertTrue($response->hasNextPage());
        $this->assertFalse($response->hasPreviousPage());
        $this->assertCount(2, $response->records);
    }

    public function test_it_handles_empty_data(): void
    {
        $response = ApiResponse::fromArray([]);

        $this->assertEquals(0, $response->getTotalRecords());
        $this->assertEquals(0, $response->getTotalPages());
        $this->assertEquals(1, $response->getCurrentPage());
        $this->assertNull($response->getNextUrl());
        $this->assertNull($response->getPreviousUrl());
        $this->assertFalse($response->hasNextPage());
        $this->assertFalse($response->hasPreviousPage());
        $this->assertEmpty($response->records);
    }

    public function test_it_converts_to_array(): void
    {
        $data = [
            'info' => ['totalrecords' => 10],
            'records' => [['id' => 1]],
            'aggregations' => ['test' => 'data'],
        ];

        $response = ApiResponse::fromArray($data);
        $array = $response->toArray();

        $this->assertEquals($data['info'], $array['info']);
        $this->assertEquals($data['records'], $array['records']);
        $this->assertEquals($data['aggregations'], $array['aggregations']);
    }
}