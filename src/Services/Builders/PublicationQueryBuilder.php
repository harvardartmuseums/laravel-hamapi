<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Services\Builders;

use Harvardartmuseums\HamAPI\Services\QueryBuilder;

class PublicationQueryBuilder extends QueryBuilder
{
    protected string $endpoint = 'publication';

    /**
     * Filter by title.
     */
    public function title(string $title): static
    {
        return $this->where('title', $title);
    }

    /**
     * Filter by publication type.
     */
    public function publicationType(string $type): static
    {
        return $this->where('publicationtype', $type);
    }

    /**
     * Filter by format.
     */
    public function format(string $format): static
    {
        return $this->where('format', $format);
    }

    /**
     * Filter by publication year.
     */
    public function year(int $year): static
    {
        return $this->where('publicationyear', $year);
    }

    /**
     * Filter by year range.
     */
    public function yearRange(int $startYear, int $endYear): static
    {
        return $this->where('publicationyear', $startYear . '-' . $endYear);
    }

    /**
     * Filter by volume number.
     */
    public function volume(string $volume): static
    {
        return $this->where('volume', $volume);
    }

    /**
     * Filter by ISBN.
     */
    public function isbn(string $isbn): static
    {
        return $this->where('isbn', $isbn);
    }

    /**
     * Filter by ISSN.
     */
    public function issn(string $issn): static
    {
        return $this->where('issn', $issn);
    }

    /**
     * Filter by citation.
     */
    public function citation(string $citation): static
    {
        return $this->where('citation', $citation);
    }

    /**
     * Filter by object count range.
     */
    public function objectCountRange(int $min, int $max): static
    {
        return $this->where('objectcount', $min . '-' . $max);
    }

    /**
     * Filter by minimum object count.
     */
    public function minObjectCount(int $count): static
    {
        return $this->where('objectcount', $count . '-');
    }

    /**
     * Filter to primary publications.
     */
    public function primaryOnly(bool $primaryOnly = true): static
    {
        return $this->where('primaryonly', $primaryOnly ? 1 : 0);
    }

    /**
     * Sort by temporal order.
     */
    public function temporalOrder(): static
    {
        return $this->where('temporalorder', 1);
    }
}