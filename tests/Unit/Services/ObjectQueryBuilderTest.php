<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Tests\Unit\Services;

use Harvardartmuseums\HamAPI\Contracts\HamApiClientInterface;
use Harvardartmuseums\HamAPI\Services\Builders\ObjectQueryBuilder;
use Harvardartmuseums\HamAPI\Tests\TestCase;
use Mockery;

class ObjectQueryBuilderTest extends TestCase
{
    protected HamApiClientInterface $mockClient;
    protected ObjectQueryBuilder $builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockClient = Mockery::mock(HamApiClientInterface::class);
        $this->builder = new ObjectQueryBuilder($this->mockClient);
    }

    public function test_it_filters_by_classification(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with(['classification' => 'Paintings'])
            ->once()
            ->andReturn(['records' => []]);

        $this->builder->classification('Paintings')->get();
    }

    public function test_it_filters_by_multiple_classifications(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with(['classification' => 'Paintings|Drawings'])
            ->once()
            ->andReturn(['records' => []]);

        $this->builder->classification(['Paintings', 'Drawings'])->get();
    }

    public function test_it_filters_by_gallery(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with(['gallery' => 1200])
            ->once()
            ->andReturn(['records' => []]);

        $this->builder->gallery(1200)->get();
    }

    public function test_it_filters_by_multiple_galleries(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with(['gallery' => '1200|1300|1400'])
            ->once()
            ->andReturn(['records' => []]);

        $this->builder->gallery(['1200', '1300', '1400'])->get();
    }

    public function test_it_filters_by_person(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with(['person' => 'Monet'])
            ->once()
            ->andReturn(['records' => []]);

        $this->builder->person('Monet')->get();
    }

    public function test_it_filters_by_object_number(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with(['objectnumber' => '1999.123'])
            ->once()
            ->andReturn(['records' => []]);

        $this->builder->objectNumber('1999.123')->get();
    }

    public function test_it_filters_by_keyword(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with(['keyword' => 'landscape'])
            ->once()
            ->andReturn(['records' => []]);

        $this->builder->keyword('landscape')->get();
    }

    public function test_on_view_sets_gallery_to_any(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with(['gallery' => 'any'])
            ->once()
            ->andReturn(['records' => []]);

        $this->builder->onView()->get();
    }

    public function test_on_view_false_does_not_set_gallery(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with([])
            ->once()
            ->andReturn(['records' => []]);

        $this->builder->onView(false)->get();
    }

    public function test_has_image_filter(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with(['hasimage' => 1])
            ->once()
            ->andReturn(['records' => []]);

        $this->builder->hasImage()->get();
    }

    public function test_has_image_false_filter(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with(['hasimage' => 0])
            ->once()
            ->andReturn(['records' => []]);

        $this->builder->hasImage(false)->get();
    }

    public function test_date_range_filter(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with(['yearmade' => '1850-1900'])
            ->once()
            ->andReturn(['records' => []]);

        $this->builder->dateRange(1850, 1900)->get();
    }

    public function test_accession_year_filter(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with(['accessionyear' => 2020])
            ->once()
            ->andReturn(['records' => []]);

        $this->builder->accessionYear(2020)->get();
    }

    public function test_custom_parameters(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with(['foo' => 'bar', 'baz' => 'qux'])
            ->once()
            ->andReturn(['records' => []]);

        $this->builder->custom(['foo' => 'bar', 'baz' => 'qux'])->get();
    }

    public function test_chained_filters(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with([
                'classification' => 'Paintings',
                'century' => '19th century',
                'culture' => 'French',
                'hasimage' => 1,
                'size' => 20,
                'sort' => 'rank',
                'sortorder' => 'desc'
            ])
            ->once()
            ->andReturn(['records' => []]);

        $this->builder
            ->classification('Paintings')
            ->century('19th century')
            ->culture('French')
            ->hasImage()
            ->size(20)
            ->sort('rank')
            ->sortOrder('desc')
            ->get();
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}