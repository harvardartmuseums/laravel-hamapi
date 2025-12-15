<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Tests\Feature;

use Harvardartmuseums\HamAPI\Facades\Exhibitions;
use Harvardartmuseums\HamAPI\Facades\Objects;
use Harvardartmuseums\HamAPI\Facades\People;
use Harvardartmuseums\HamAPI\Facades\Publications;
use Harvardartmuseums\HamAPI\Services\Builders\ExhibitionQueryBuilder;
use Harvardartmuseums\HamAPI\Services\Builders\ObjectQueryBuilder;
use Harvardartmuseums\HamAPI\Services\Builders\PersonQueryBuilder;
use Harvardartmuseums\HamAPI\Services\Builders\PublicationQueryBuilder;
use Harvardartmuseums\HamAPI\Tests\TestCase;
use Illuminate\Support\Facades\Http;

class FacadesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Http::fake([
            '*' => Http::response(['info' => ['totalrecords' => 10], 'records' => []]),
        ]);
    }

    public function test_objects_facade_returns_query_builder(): void
    {
        $builder = Objects::query();

        $this->assertInstanceOf(ObjectQueryBuilder::class, $builder);
    }

    public function test_objects_facade_can_chain_methods(): void
    {
        $builder = Objects::classification('Paintings')
            ->century('19th century')
            ->hasImage()
            ->limit(20);

        $this->assertInstanceOf(ObjectQueryBuilder::class, $builder);

        $results = $builder->get();
        $this->assertIsArray($results);
    }

    public function test_objects_facade_static_methods_work(): void
    {
        $results = Objects::onView()->limit(10)->get();

        $this->assertIsArray($results);
        $this->assertArrayHasKey('info', $results);
    }

    public function test_people_facade_returns_query_builder(): void
    {
        $builder = People::query();

        $this->assertInstanceOf(PersonQueryBuilder::class, $builder);
    }

    public function test_people_facade_can_chain_methods(): void
    {
        $builder = People::role('Artist')
            ->culture('French')
            ->minObjectCount(10)
            ->limit(20);

        $this->assertInstanceOf(PersonQueryBuilder::class, $builder);

        $results = $builder->get();
        $this->assertIsArray($results);
    }

    public function test_exhibitions_facade_returns_query_builder(): void
    {
        $builder = Exhibitions::query();

        $this->assertInstanceOf(ExhibitionQueryBuilder::class, $builder);
    }

    public function test_exhibitions_facade_can_filter_by_status(): void
    {
        $currentExhibitions = Exhibitions::current()->get();
        $pastExhibitions = Exhibitions::past()->get();
        $upcomingExhibitions = Exhibitions::upcoming()->get();

        $this->assertIsArray($currentExhibitions);
        $this->assertIsArray($pastExhibitions);
        $this->assertIsArray($upcomingExhibitions);
    }

    public function test_publications_facade_returns_query_builder(): void
    {
        $builder = Publications::query();

        $this->assertInstanceOf(PublicationQueryBuilder::class, $builder);
    }

    public function test_publications_facade_can_chain_methods(): void
    {
        $builder = Publications::yearRange(2010, 2020)
            ->publicationType('Book')
            ->primaryOnly()
            ->temporalOrder()
            ->limit(50);

        $this->assertInstanceOf(PublicationQueryBuilder::class, $builder);

        $results = $builder->get();
        $this->assertIsArray($results);
    }

    public function test_facade_aliases_are_registered(): void
    {
        // Test that the aliases are available
        $this->assertTrue(class_exists('HamObjects'));
        $this->assertTrue(class_exists('HamPeople'));
        $this->assertTrue(class_exists('HamExhibitions'));
        $this->assertTrue(class_exists('HamPublications'));
    }

    public function test_facades_can_find_by_id(): void
    {
        Http::fake([
            '*/object/123*' => Http::response(['id' => 123, 'title' => 'Test Object']),
            '*/person/456*' => Http::response(['id' => 456, 'name' => 'Test Person']),
            '*/exhibition/789*' => Http::response(['id' => 789, 'title' => 'Test Exhibition']),
            '*/publication/999*' => Http::response(['id' => 999, 'title' => 'Test Publication']),
        ]);

        $object = Objects::find(123);
        $person = People::find(456);
        $exhibition = Exhibitions::find(789);
        $publication = Publications::find(999);

        $this->assertEquals(123, $object['id']);
        $this->assertEquals(456, $person['id']);
        $this->assertEquals(789, $exhibition['id']);
        $this->assertEquals(999, $publication['id']);
    }
}