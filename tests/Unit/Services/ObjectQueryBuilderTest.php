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
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['classification' => 'Paintings'])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->classification('Paintings')->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_it_filters_by_multiple_classifications(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['classification' => 'Paintings|Drawings'])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->classification(['Paintings', 'Drawings'])->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_it_filters_by_gallery(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['gallery' => 1200])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->gallery(1200)->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_it_filters_by_multiple_galleries(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['gallery' => '1200|1300|1400'])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->gallery(['1200', '1300', '1400'])->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_it_filters_by_person(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['person' => 'Monet'])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->person('Monet')->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_it_filters_by_object_number(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['objectnumber' => '1999.123'])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->objectNumber('1999.123')->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_it_filters_by_keyword(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['keyword' => 'landscape'])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->keyword('landscape')->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_on_view_sets_gallery_to_any(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['gallery' => 'any'])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->onView()->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_on_view_false_does_not_set_gallery(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with([])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->onView(false)->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_has_image_filter(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['hasimage' => 1])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->hasImage()->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_has_image_false_filter(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['hasimage' => 0])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->hasImage(false)->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_date_range_filter(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['yearmade' => '1850-1900'])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->dateRange(1850, 1900)->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_accession_year_filter(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['accessionyear' => 2020])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->accessionYear(2020)->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_custom_parameters(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['foo' => 'bar', 'baz' => 'qux'])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->custom(['foo' => 'bar', 'baz' => 'qux'])->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_chained_filters(): void
    {
        $expectedResult = ['records' => []];

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
            ->andReturn($expectedResult);

        $result = $this->builder
            ->classification('Paintings')
            ->century('19th century')
            ->culture('French')
            ->hasImage()
            ->size(20)
            ->sort('rank')
            ->sortOrder('desc')
            ->get();

        $this->assertEquals($expectedResult, $result);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}