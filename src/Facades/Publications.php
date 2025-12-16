<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Facades;

use Harvardartmuseums\HamAPI\Services\Builders\PublicationQueryBuilder;
use Illuminate\Support\Facades\Facade;

/**
 * @method static PublicationQueryBuilder query()
 * @method static PublicationQueryBuilder title(string $title)
 * @method static PublicationQueryBuilder publicationType(string $type)
 * @method static PublicationQueryBuilder format(string $format)
 * @method static PublicationQueryBuilder year(int $year)
 * @method static PublicationQueryBuilder yearRange(int $startYear, int $endYear)
 * @method static PublicationQueryBuilder volume(string $volume)
 * @method static PublicationQueryBuilder isbn(string $isbn)
 * @method static PublicationQueryBuilder issn(string $issn)
 * @method static PublicationQueryBuilder citation(string $citation)
 * @method static PublicationQueryBuilder objectCountRange(int $min, int $max)
 * @method static PublicationQueryBuilder minObjectCount(int $count)
 * @method static PublicationQueryBuilder primaryOnly(bool $primaryOnly = true)
 * @method static PublicationQueryBuilder temporalOrder()
 * @method static PublicationQueryBuilder size(int $size)
 * @method static PublicationQueryBuilder limit(int $limit)
 * @method static PublicationQueryBuilder page(int $page)
 * @method static PublicationQueryBuilder offset(int $offset)
 * @method static PublicationQueryBuilder from(int $from)
 * @method static PublicationQueryBuilder sort(string $sort)
 * @method static PublicationQueryBuilder sortOrder(string $order)
 * @method static PublicationQueryBuilder fields(array|string $fields)
 * @method static PublicationQueryBuilder facets(array|string $facets)
 * @method static PublicationQueryBuilder where(string $field, mixed $value)
 * @method static PublicationQueryBuilder search(string $query)
 * @method static array find(int|string $id)
 * @method static array get()
 * @method static array|null first()
 * @method static int count()
 * @method static array all()
 *
 * @see \Harvardartmuseums\HamAPI\Services\Builders\PublicationQueryBuilder
 */
class Publications extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return PublicationQueryBuilder::class;
    }

    /**
     * Resolve a new instance of the query builder.
     */
    public static function getFacadeRoot()
    {
        return app(PublicationQueryBuilder::class);
    }

    /**
     * Create a new query builder instance.
     */
    public static function query(): PublicationQueryBuilder
    {
        return app(PublicationQueryBuilder::class);
    }
}