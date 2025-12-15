<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Facades;

use Harvardartmuseums\HamAPI\Services\Builders\ExhibitionQueryBuilder;
use Illuminate\Support\Facades\Facade;

/**
 * @method static ExhibitionQueryBuilder query()
 * @method static ExhibitionQueryBuilder title(string $title)
 * @method static ExhibitionQueryBuilder status(string $status)
 * @method static ExhibitionQueryBuilder venue(string|array $venue)
 * @method static ExhibitionQueryBuilder beginDate(string $date)
 * @method static ExhibitionQueryBuilder endDate(string $date)
 * @method static ExhibitionQueryBuilder dateRange(string $startDate, string $endDate)
 * @method static ExhibitionQueryBuilder current()
 * @method static ExhibitionQueryBuilder past()
 * @method static ExhibitionQueryBuilder upcoming()
 * @method static ExhibitionQueryBuilder gallery(string|array|int $gallery)
 * @method static ExhibitionQueryBuilder organizer(string $organizer)
 * @method static ExhibitionQueryBuilder hasImage(bool $hasImage = true)
 * @method static ExhibitionQueryBuilder exhibitionId(int $exhibitionId)
 * @method static ExhibitionQueryBuilder temporalOrder()
 * @method static ExhibitionQueryBuilder size(int $size)
 * @method static ExhibitionQueryBuilder limit(int $limit)
 * @method static ExhibitionQueryBuilder page(int $page)
 * @method static ExhibitionQueryBuilder offset(int $offset)
 * @method static ExhibitionQueryBuilder from(int $from)
 * @method static ExhibitionQueryBuilder sort(string $sort)
 * @method static ExhibitionQueryBuilder sortOrder(string $order)
 * @method static ExhibitionQueryBuilder fields(array|string $fields)
 * @method static ExhibitionQueryBuilder facets(array|string $facets)
 * @method static ExhibitionQueryBuilder where(string $field, mixed $value)
 * @method static ExhibitionQueryBuilder search(string $query)
 * @method static array find(int|string $id)
 * @method static array get()
 * @method static array|null first()
 * @method static int count()
 * @method static array all()
 *
 * @see \Harvardartmuseums\HamAPI\Services\Builders\ExhibitionQueryBuilder
 */
class Exhibitions extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return ExhibitionQueryBuilder::class;
    }

    /**
     * Resolve a new instance of the query builder.
     */
    protected static function getFacadeRoot()
    {
        return app(ExhibitionQueryBuilder::class);
    }

    /**
     * Create a new query builder instance.
     */
    public static function query(): ExhibitionQueryBuilder
    {
        return app(ExhibitionQueryBuilder::class);
    }
}