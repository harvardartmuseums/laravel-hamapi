<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Services\Builders;

use Harvardartmuseums\HamAPI\Services\QueryBuilder;

class GalleryQueryBuilder extends QueryBuilder
{
    protected string $endpoint = 'gallery';

    /**
     * Filter by gallery name.
     */
    public function name(string $name): static
    {
        return $this->where('name', $name);
    }

    /**
     * Filter by floor.
     */
    public function floor(int $floor): static
    {
        return $this->where('floor', $floor);
    }

    /**
     * Filter by theme.
     */
    public function theme(string $theme): static
    {
        return $this->where('theme', $theme);
    }

    /**
     * Filter by gallery ID.
     */
    public function galleryId(int $galleryId): static
    {
        return $this->where('galleryid', $galleryId);
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
     * Filter to galleries with objects.
     */
    public function hasObjects(bool $hasObjects = true): static
    {
        if ($hasObjects) {
            return $this->minObjectCount(1);
        }
        return $this;
    }
}