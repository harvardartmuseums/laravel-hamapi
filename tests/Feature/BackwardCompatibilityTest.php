<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Tests\Feature;

use Harvardartmuseums\HamAPI\Classes\HamSpectrumFacade;
use Harvardartmuseums\HamAPI\Classes\HamObjectFacade;
use Harvardartmuseums\HamAPI\Classes\HamExhibitionFacade;
use Harvardartmuseums\HamAPI\Tests\TestCase;
use Illuminate\Support\Facades\Http;

class BackwardCompatibilityTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Http::fake([
            '*/spectrum/*' => Http::response(['id' => 123, 'daynumber' => 100]),
            '*/object/*' => Http::response(['id' => 456, 'title' => 'Test Object']),
            '*/exhibition/*' => Http::response(['id' => 789, 'title' => 'Test Exhibition']),
            '*' => Http::response(['info' => ['totalrecords' => 10], 'records' => []]),
        ]);
    }

    public function test_old_facades_are_registered(): void
    {
        $this->assertInstanceOf(
            \Harvardartmuseums\HamAPI\Classes\HamSpectrum::class,
            app('hamspectrum')
        );

        $this->assertInstanceOf(
            \Harvardartmuseums\HamAPI\Classes\HamObject::class,
            app('hamobject')
        );

        $this->assertInstanceOf(
            \Harvardartmuseums\HamAPI\Classes\HamExhibition::class,
            app('hamexhibition')
        );
    }

    public function test_spectrum_facade_find_method_works(): void
    {
        $result = HamSpectrumFacade::find(123);

        $this->assertNotNull($result);
    }

    public function test_object_facade_chaining_works(): void
    {
        $result = HamObjectFacade::limit(10)
            ->sort('title')
            ->sortorder('asc')
            ->findCount();

        $this->assertNotNull($result);
    }

    public function test_exhibition_facade_methods_work(): void
    {
        $result = HamExhibitionFacade::query('test')
            ->from(0)
            ->limit(20)
            ->findCount();

        $this->assertNotNull($result);
    }

    public function test_old_config_keys_work(): void
    {
        // The old HamApi class uses 'api_url' config key
        $this->assertEquals(
            config('hamapi.base_url'),
            config('hamapi.api_url')
        );
    }
}