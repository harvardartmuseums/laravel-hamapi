<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Tests\Unit\Services;

use Harvardartmuseums\HamAPI\Contracts\HamApiClientInterface;
use Harvardartmuseums\HamAPI\Services\Builders\ObjectQueryBuilder;
use Harvardartmuseums\HamAPI\Tests\TestCase;
use Mockery;

class QueryBuilderTest extends TestCase
{
    protected HamApiClientInterface $mockClient;
    protected ObjectQueryBuilder $builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockClient = Mockery::mock(HamApiClientInterface::class);
        $this->builder = new ObjectQueryBuilder($this->mockClient);
    }

    public function test_it_sets_size_parameter(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['size' => 50])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->size(50)->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_it_limits_size_to_api_maximum(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['size' => 100])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->size(200)->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_limit_is_alias_for_size(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['size' => 25])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->limit(25)->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_it_sets_page_parameter(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['page' => 3])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->page(3)->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_offset_converts_to_page(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['size' => 20, 'page' => 3])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->size(20)->offset(40)->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_it_sets_sort_parameters(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['sort' => 'title', 'sortorder' => 'desc'])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->sort('title')->sortOrder('desc')->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_it_sets_fields_parameter(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['fields' => 'id,title,dated'])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->fields(['id', 'title', 'dated'])->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_it_sets_fields_from_string(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['fields' => 'id,title'])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->fields('id,title')->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_it_sets_search_query(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['q' => 'monet'])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->search('monet')->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_query_is_alias_for_search(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['q' => 'picasso'])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->query('picasso')->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_where_sets_parameters(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['custom_field' => 'value'])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->where('custom_field', 'value')->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_where_joins_array_values(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with(['colors' => 'red|blue|green'])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->where('colors', ['red', 'blue', 'green'])->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_find_calls_single_object_endpoint(): void
    {
        $this->mockClient->shouldReceive('object')
            ->with(123, [])
            ->once()
            ->andReturn(['id' => 123]);

        $result = $this->builder->find(123);

        $this->assertEquals(['id' => 123], $result);
    }

    public function test_first_returns_first_record(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with(['size' => 1])
            ->once()
            ->andReturn(['records' => [['id' => 1], ['id' => 2]]]);

        $result = $this->builder->first();

        $this->assertEquals(['id' => 1], $result);
    }

    public function test_first_returns_null_when_no_records(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with(['size' => 1])
            ->once()
            ->andReturn(['records' => []]);

        $result = $this->builder->first();

        $this->assertNull($result);
    }

    public function test_count_returns_total_records(): void
    {
        $this->mockClient->shouldReceive('objects')
            ->with([])
            ->once()
            ->andReturn(['info' => ['totalrecords' => 42]]);

        $count = $this->builder->count();

        $this->assertEquals(42, $count);
    }

    public function test_all_is_alias_for_get(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with([])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder->all();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_clone_creates_independent_instance(): void
    {
        $expectedResult = ['records' => []];

        $original = $this->builder->size(10)->page(2);
        $clone = $original->clone();

        $clone->size(20)->page(3);

        // Original should not be affected
        $this->mockClient->shouldReceive('objects')
            ->with(['size' => 10, 'page' => 2])
            ->once()
            ->andReturn($expectedResult);

        $result = $original->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_reset_clears_all_parameters(): void
    {
        $expectedResult = ['records' => []];

        $this->mockClient->shouldReceive('objects')
            ->with([])
            ->once()
            ->andReturn($expectedResult);

        $result = $this->builder
            ->size(50)
            ->page(3)
            ->sort('title')
            ->reset()
            ->get();

        $this->assertEquals($expectedResult, $result);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}