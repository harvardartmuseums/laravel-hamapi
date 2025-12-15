<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Tests\Unit\DTOs;

use Harvardartmuseums\HamAPI\DTOs\ArtObject;
use Harvardartmuseums\HamAPI\Tests\TestCase;

class ArtObjectTest extends TestCase
{
    public function test_it_creates_from_array(): void
    {
        $data = [
            'id' => 123,
            'objectnumber' => '1999.123',
            'title' => 'Test Artwork',
            'dated' => '1999',
            'primaryimageurl' => 'https://example.com/image.jpg',
            'people' => [
                ['name' => 'Artist One', 'role' => 'Artist'],
                ['name' => 'Curator One', 'role' => 'Curator'],
            ],
        ];

        $object = ArtObject::fromArray($data);

        $this->assertEquals(123, $object->id);
        $this->assertEquals('1999.123', $object->objectnumber);
        $this->assertEquals('Test Artwork', $object->title);
        $this->assertEquals('1999', $object->dated);
        $this->assertTrue($object->hasImage());
        $this->assertEquals('Test Artwork', $object->getDisplayTitle());
    }

    public function test_it_handles_untitled_objects(): void
    {
        $object = ArtObject::fromArray(['id' => 1]);

        $this->assertEquals('Untitled', $object->getDisplayTitle());
    }

    public function test_it_identifies_objects_without_images(): void
    {
        $object = ArtObject::fromArray(['id' => 1]);

        $this->assertFalse($object->hasImage());
    }

    public function test_it_extracts_artists(): void
    {
        $data = [
            'id' => 1,
            'people' => [
                ['name' => 'Artist One', 'role' => 'Artist'],
                ['name' => 'Artist Two', 'role' => 'Artist'],
                ['name' => 'Curator One', 'role' => 'Curator'],
            ],
        ];

        $object = ArtObject::fromArray($data);
        $artists = $object->getArtists();

        $this->assertCount(2, $artists);
        $this->assertEquals('Artist One', $artists[0]['name']);
        $this->assertEquals('Artist Two', $artists[1]['name']);
    }

    public function test_it_gets_primary_artist(): void
    {
        $data = [
            'id' => 1,
            'people' => [
                ['name' => 'Primary Artist', 'role' => 'Artist'],
                ['name' => 'Secondary Artist', 'role' => 'Artist'],
            ],
        ];

        $object = ArtObject::fromArray($data);

        $this->assertEquals('Primary Artist', $object->getPrimaryArtist());
    }

    public function test_it_returns_null_for_primary_artist_when_no_artists(): void
    {
        $object = ArtObject::fromArray(['id' => 1, 'people' => []]);

        $this->assertNull($object->getPrimaryArtist());
    }

    public function test_it_converts_to_array(): void
    {
        $data = [
            'id' => 123,
            'title' => 'Test',
            'custom_field' => 'value',
        ];

        $object = ArtObject::fromArray($data);

        $this->assertEquals($data, $object->toArray());
    }
}