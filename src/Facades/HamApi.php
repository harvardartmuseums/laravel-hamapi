<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array objects(array $params = [])
 * @method static array object(int|string $id, array $params = [])
 * @method static array exhibitions(array $params = [])
 * @method static array exhibition(int|string $id, array $params = [])
 * @method static array publications(array $params = [])
 * @method static array publication(int|string $id, array $params = [])
 * @method static array galleries(array $params = [])
 * @method static array gallery(int|string $id, array $params = [])
 * @method static array people(array $params = [])
 * @method static array person(int|string $id, array $params = [])
 * @method static array classifications(array $params = [])
 * @method static array classification(int|string $id, array $params = [])
 * @method static array periods(array $params = [])
 * @method static array period(int|string $id, array $params = [])
 * @method static array cultures(array $params = [])
 * @method static array culture(int|string $id, array $params = [])
 * @method static array mediums(array $params = [])
 * @method static array medium(int|string $id, array $params = [])
 * @method static array techniques(array $params = [])
 * @method static array technique(int|string $id, array $params = [])
 * @method static array worktypes(array $params = [])
 * @method static array worktype(int|string $id, array $params = [])
 * @method static array places(array $params = [])
 * @method static array place(int|string $id, array $params = [])
 * @method static array centuries(array $params = [])
 * @method static array century(int|string $id, array $params = [])
 * @method static array colors(array $params = [])
 * @method static array color(int|string $id, array $params = [])
 * @method static array spectra(array $params = [])
 * @method static array spectrum(int|string $id, array $params = [])
 * @method static array groups(array $params = [])
 * @method static array group(int|string $id, array $params = [])
 * @method static array get(string $endpoint, array $params = [])
 *
 * @see \Harvardartmuseums\HamAPI\Contracts\HamApiClientInterface
 */
class HamApi extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'hamapi';
    }
}