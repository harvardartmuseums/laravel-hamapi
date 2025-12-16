<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Tests\Unit\Services;

use Harvardartmuseums\HamAPI\Contracts\HamApiClientInterface;
use Harvardartmuseums\HamAPI\Services\BrowseService;
use Harvardartmuseums\HamAPI\Tests\TestCase;
use Mockery;

class BrowseServiceTest extends TestCase
{
    protected HamApiClientInterface $mockClient;
    protected BrowseService $browseService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockClient = Mockery::mock(HamApiClientInterface::class);
        $this->browseService = new BrowseService($this->mockClient);
    }

    public function test_search_with_keyword(): void
    {
        // First, object number search returns no results (so it falls back to keyword)
        $this->mockClient->shouldReceive('objects')
            ->with(Mockery::on(function ($params) {
                return isset($params['objectnumber']) && $params['objectnumber'] === 'monet';
            }))
            ->once()
            ->andReturn(['info' => ['totalrecords' => 0], 'records' => []]);

        // Then keyword search is performed
        $this->mockClient->shouldReceive('objects')
            ->with(Mockery::on(function ($params) {
                return $params['keyword'] === 'monet' &&
                       $params['size'] === 12 &&
                       $params['page'] === 1 &&
                       $params['sort'] === 'rank' &&
                       $params['sortorder'] === 'asc';
            }))
            ->once()
            ->andReturn(['info' => ['totalrecords' => 10], 'records' => []]);

        $result = $this->browseService->search(['q' => 'monet']);

        $this->assertEquals(10, $result['info']['totalrecords']);
    }

    public function test_search_tries_gallery_first_when_on_view(): void
    {
        // First try gallery search
        $this->mockClient->shouldReceive('objects')
            ->with(Mockery::on(function ($params) {
                return isset($params['gallery']) && $params['gallery'] === '1200';
            }))
            ->once()
            ->andReturn(['info' => ['totalrecords' => 5], 'records' => []]);

        $result = $this->browseService->search(['q' => '1200', 'onview' => true]);

        $this->assertEquals(5, $result['info']['totalrecords']);
    }

    public function test_search_tries_object_number_if_gallery_fails(): void
    {
        // Gallery search returns no results
        $this->mockClient->shouldReceive('objects')
            ->with(Mockery::on(function ($params) {
                return isset($params['gallery']) && $params['gallery'] === '1999.123';
            }))
            ->once()
            ->andReturn(['info' => ['totalrecords' => 0], 'records' => []]);

        // Then try object number
        $this->mockClient->shouldReceive('objects')
            ->with(Mockery::on(function ($params) {
                return isset($params['objectnumber']) && $params['objectnumber'] === '1999.123';
            }))
            ->once()
            ->andReturn(['info' => ['totalrecords' => 1], 'records' => []]);

        $result = $this->browseService->search(['q' => '1999.123', 'onview' => true]);

        $this->assertEquals(1, $result['info']['totalrecords']);
    }

    public function test_search_falls_back_to_keyword_search(): void
    {
        // Object number search returns no results
        $this->mockClient->shouldReceive('objects')
            ->with(Mockery::on(function ($params) {
                return isset($params['objectnumber']) && $params['objectnumber'] === 'test';
            }))
            ->once()
            ->andReturn(['info' => ['totalrecords' => 0], 'records' => []]);

        // Fall back to keyword search
        $this->mockClient->shouldReceive('objects')
            ->with(Mockery::on(function ($params) {
                return isset($params['keyword']) && $params['keyword'] === 'test';
            }))
            ->once()
            ->andReturn(['info' => ['totalrecords' => 20], 'records' => []]);

        $result = $this->browseService->search(['q' => 'test']);

        $this->assertEquals(20, $result['info']['totalrecords']);
    }

    public function test_search_applies_all_filters(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with(Mockery::on(function ($params) {
                return $params['classification'] === 'Paintings' &&
                       $params['century'] === '19th century' &&
                       $params['culture'] === 'French' &&
                       $params['gallery'] === 'any' &&
                       $params['hasimage'] === 1;
            }))
            ->once()
            ->andReturn(['info' => ['totalrecords' => 15], 'records' => []]);

        $filters = [
            'classification' => 'Paintings',
            'century' => '19th century',
            'culture' => 'French',
            'onview' => true,
            'hasimage' => true
        ];

        $result = $this->browseService->search($filters);

        $this->assertEquals(15, $result['info']['totalrecords']);
    }

    public function test_browse_gallery(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with(Mockery::on(function ($params) {
                return $params['gallery'] === 1200 &&
                       $params['size'] === 24 &&
                       $params['sort'] === 'title';
            }))
            ->once()
            ->andReturn(['info' => ['totalrecords' => 50], 'records' => []]);

        $result = $this->browseService->browseGallery(1200, [
            'limit' => 24,
            'sort' => 'title'
        ]);

        $this->assertEquals(50, $result['info']['totalrecords']);
    }

    public function test_browse_exhibition(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with(Mockery::on(function ($params) {
                return $params['exhibition'] === 5000 &&
                       $params['hasimage'] === 1;
            }))
            ->once()
            ->andReturn(['info' => ['totalrecords' => 30], 'records' => []]);

        $result = $this->browseService->browseExhibition(5000, [
            'hasimage' => true
        ]);

        $this->assertEquals(30, $result['info']['totalrecords']);
    }

    public function test_browse_person(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with(Mockery::on(function ($params) {
                return $params['person'] === 123 &&
                       $params['role'] === 'Artist';
            }))
            ->once()
            ->andReturn(['info' => ['totalrecords' => 25], 'records' => []]);

        $result = $this->browseService->browsePerson(123, [
            'role' => 'Artist'
        ]);

        $this->assertEquals(25, $result['info']['totalrecords']);
    }

    public function test_browse_on_view(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with(Mockery::on(function ($params) {
                return $params['gallery'] === 'any' &&
                       $params['classification'] === 'Sculpture' &&
                       $params['sort'] === 'gallery';
            }))
            ->once()
            ->andReturn(['info' => ['totalrecords' => 100], 'records' => []]);

        $result = $this->browseService->browseOnView([
            'classification' => 'Sculpture'
        ]);

        $this->assertEquals(100, $result['info']['totalrecords']);
    }

    public function test_random(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with(Mockery::on(function ($params) {
                return $params['size'] === 6 &&
                       $params['sort'] === 'random' &&
                       $params['hasimage'] === 1;
            }))
            ->once()
            ->andReturn(['info' => ['totalrecords' => 1000], 'records' => []]);

        $result = $this->browseService->random(6, ['hasimage' => true]);

        $this->assertEquals(1000, $result['info']['totalrecords']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}