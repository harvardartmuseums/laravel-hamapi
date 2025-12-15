<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Facades;

use Harvardartmuseums\HamAPI\Services\Builders\ObjectQueryBuilder;
use Illuminate\Support\Facades\Facade;

/**
 * @method static ObjectQueryBuilder query()
 * @method static ObjectQueryBuilder classification(string|array $classification)
 * @method static ObjectQueryBuilder gallery(string|array|int $gallery)
 * @method static ObjectQueryBuilder century(string|array $century)
 * @method static ObjectQueryBuilder culture(string|array $culture)
 * @method static ObjectQueryBuilder person(string|array|int $person)
 * @method static ObjectQueryBuilder exhibition(int|string $exhibitionId)
 * @method static ObjectQueryBuilder group(string $group)
 * @method static ObjectQueryBuilder exactTitle(string $title)
 * @method static ObjectQueryBuilder objectNumber(string $objectNumber)
 * @method static ObjectQueryBuilder keyword(string $keyword)
 * @method static ObjectQueryBuilder technique(string|array $technique)
 * @method static ObjectQueryBuilder medium(string|array $medium)
 * @method static ObjectQueryBuilder place(string|array $place)
 * @method static ObjectQueryBuilder worktype(string|array $worktype)
 * @method static ObjectQueryBuilder color(string|array $color)
 * @method static ObjectQueryBuilder period(string|array $period)
 * @method static ObjectQueryBuilder relatedTo(string $objectId)
 * @method static ObjectQueryBuilder onView(bool $onView = true)
 * @method static ObjectQueryBuilder hasImage(bool $hasImage = true)
 * @method static ObjectQueryBuilder size(int $size)
 * @method static ObjectQueryBuilder limit(int $limit)
 * @method static ObjectQueryBuilder page(int $page)
 * @method static ObjectQueryBuilder offset(int $offset)
 * @method static ObjectQueryBuilder from(int $from)
 * @method static ObjectQueryBuilder sort(string $sort)
 * @method static ObjectQueryBuilder sortOrder(string $order)
 * @method static ObjectQueryBuilder fields(array|string $fields)
 * @method static ObjectQueryBuilder facets(array|string $facets)
 * @method static ObjectQueryBuilder where(string $field, mixed $value)
 * @method static ObjectQueryBuilder search(string $query)
 * @method static array find(int|string $id)
 * @method static array get()
 * @method static array|null first()
 * @method static int count()
 * @method static array all()
 *
 * @see \Harvardartmuseums\HamAPI\Services\Builders\ObjectQueryBuilder
 */
class Objects extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return ObjectQueryBuilder::class;
    }

    /**
     * Resolve a new instance of the query builder.
     */
    protected static function getFacadeRoot()
    {
        return app(ObjectQueryBuilder::class);
    }

    /**
     * Create a new query builder instance.
     */
    public static function query(): ObjectQueryBuilder
    {
        return app(ObjectQueryBuilder::class);
    }
}