<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Services\Builders;

use Harvardartmuseums\HamAPI\Services\QueryBuilder;

/**
 * Generic query builder for resources without specialized builders.
 */
class GenericQueryBuilder extends QueryBuilder
{
    /**
     * Create a new generic query builder.
     */
    public function __construct($client, string $endpoint)
    {
        parent::__construct($client);
        $this->endpoint = $endpoint;
    }
}