<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Services\Builders;

use Harvardartmuseums\HamAPI\Services\QueryBuilder;

class ClassificationQueryBuilder extends QueryBuilder
{
    protected string $endpoint = 'classification';

    /**
     * Filter by classification name.
     */
    public function name(string $name): static
    {
        return $this->where('name', $name);
    }

    /**
     * Filter by parent classification.
     */
    public function parent(string $parent): static
    {
        return $this->where('parent', $parent);
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
}