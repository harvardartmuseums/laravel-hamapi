<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Services\Builders;

use Harvardartmuseums\HamAPI\Services\QueryBuilder;

class ExhibitionQueryBuilder extends QueryBuilder
{
    protected string $endpoint = 'exhibition';

    /**
     * Filter by title.
     */
    public function title(string $title): static
    {
        return $this->where('title', $title);
    }

    /**
     * Filter by status.
     */
    public function status(string $status): static
    {
        return $this->where('status', $status);
    }

    /**
     * Filter by venue.
     *
     * @param string|array<string> $venue
     */
    public function venue(string|array $venue): static
    {
        return $this->where('venue', $venue);
    }

    /**
     * Filter by begin date.
     */
    public function beginDate(string $date): static
    {
        return $this->where('begindate', $date);
    }

    /**
     * Filter by end date.
     */
    public function endDate(string $date): static
    {
        return $this->where('enddate', $date);
    }

    /**
     * Filter by date range.
     */
    public function dateRange(string $startDate, string $endDate): static
    {
        return $this->beginDate($startDate)->endDate($endDate);
    }

    /**
     * Filter to current exhibitions.
     */
    public function current(): static
    {
        return $this->status('current');
    }

    /**
     * Filter to past exhibitions.
     */
    public function past(): static
    {
        return $this->status('past');
    }

    /**
     * Filter to upcoming exhibitions.
     */
    public function upcoming(): static
    {
        return $this->status('upcoming');
    }

    /**
     * Filter by gallery.
     *
     * @param string|array<string>|int|array<int> $gallery
     */
    public function gallery(string|array|int $gallery): static
    {
        return $this->where('gallery', $gallery);
    }

    /**
     * Filter by organizer.
     */
    public function organizer(string $organizer): static
    {
        return $this->where('organizer', $organizer);
    }

    /**
     * Filter to exhibitions with images.
     */
    public function hasImage(bool $hasImage = true): static
    {
        return $this->where('hasimage', $hasImage ? 1 : 0);
    }

    /**
     * Filter by exhibition ID.
     */
    public function exhibitionId(int $exhibitionId): static
    {
        return $this->where('exhibitionid', $exhibitionId);
    }

    /**
     * Sort by temporal order.
     */
    public function temporalOrder(): static
    {
        return $this->where('temporalorder', 1);
    }
}