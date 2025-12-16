<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Facades;

use Harvardartmuseums\HamAPI\Services\Builders\PersonQueryBuilder;
use Illuminate\Support\Facades\Facade;

/**
 * @method static PersonQueryBuilder query()
 * @method static PersonQueryBuilder name(string $name)
 * @method static PersonQueryBuilder displayName(string $displayName)
 * @method static PersonQueryBuilder birthPlace(string $birthPlace)
 * @method static PersonQueryBuilder deathPlace(string $deathPlace)
 * @method static PersonQueryBuilder role(string|array $role)
 * @method static PersonQueryBuilder gender(string $gender)
 * @method static PersonQueryBuilder culture(string|array $culture)
 * @method static PersonQueryBuilder personId(int $personId)
 * @method static PersonQueryBuilder ulanId(string $ulanId)
 * @method static PersonQueryBuilder viafId(string $viafId)
 * @method static PersonQueryBuilder wikipediaId(string $wikipediaId)
 * @method static PersonQueryBuilder objectCountRange(int $min, int $max)
 * @method static PersonQueryBuilder minObjectCount(int $count)
 * @method static PersonQueryBuilder dateRange(int $yearStart, int $yearEnd)
 * @method static PersonQueryBuilder size(int $size)
 * @method static PersonQueryBuilder limit(int $limit)
 * @method static PersonQueryBuilder page(int $page)
 * @method static PersonQueryBuilder offset(int $offset)
 * @method static PersonQueryBuilder from(int $from)
 * @method static PersonQueryBuilder sort(string $sort)
 * @method static PersonQueryBuilder sortOrder(string $order)
 * @method static PersonQueryBuilder fields(array|string $fields)
 * @method static PersonQueryBuilder facets(array|string $facets)
 * @method static PersonQueryBuilder where(string $field, mixed $value)
 * @method static PersonQueryBuilder search(string $query)
 * @method static array find(int|string $id)
 * @method static array get()
 * @method static array|null first()
 * @method static int count()
 * @method static array all()
 *
 * @see \Harvardartmuseums\HamAPI\Services\Builders\PersonQueryBuilder
 */
class People extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return PersonQueryBuilder::class;
    }

    /**
     * Resolve a new instance of the query builder.
     */
    public static function getFacadeRoot()
    {
        return app(PersonQueryBuilder::class);
    }

    /**
     * Create a new query builder instance.
     */
    public static function query(): PersonQueryBuilder
    {
        return app(PersonQueryBuilder::class);
    }
}