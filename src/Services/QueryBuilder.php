<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Services;

use Harvardartmuseums\HamAPI\Contracts\HamApiClientInterface;

abstract class QueryBuilder
{
    protected array $parameters = [];
    protected ?int $id = null;
    protected string $endpoint;
    protected HamApiClientInterface $client;

    public function __construct(HamApiClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Set the number of records to return.
     */
    public function size(int $size): static
    {
        $this->parameters['size'] = min($size, 100); // API max is 100
        return $this;
    }

    /**
     * Alias for size method.
     */
    public function limit(int $limit): static
    {
        return $this->size($limit);
    }

    /**
     * Set the page number.
     */
    public function page(int $page): static
    {
        $this->parameters['page'] = $page;
        return $this;
    }

    /**
     * Set the offset (converted to page number).
     */
    public function offset(int $offset): static
    {
        $size = $this->parameters['size'] ?? 10;
        $this->parameters['page'] = (int) floor($offset / $size) + 1;
        return $this;
    }

    /**
     * Alias for offset method.
     */
    public function from(int $from): static
    {
        return $this->offset($from);
    }

    /**
     * Set the sort field.
     */
    public function sort(string $sort): static
    {
        $this->parameters['sort'] = $sort;
        return $this;
    }

    /**
     * Set the sort order.
     */
    public function sortOrder(string $order): static
    {
        $this->parameters['sortorder'] = strtolower($order);
        return $this;
    }

    /**
     * Set fields to return.
     *
     * @param array<string>|string $fields
     */
    public function fields(array|string $fields): static
    {
        if (is_array($fields)) {
            $fields = implode(',', $fields);
        }
        $this->parameters['fields'] = $fields;
        return $this;
    }

    /**
     * Set facets to return.
     *
     * @param array<string>|string $facets
     */
    public function facets(array|string $facets): static
    {
        if (is_array($facets)) {
            $facets = implode(',', $facets);
        }
        $this->parameters['facet'] = $facets;
        return $this;
    }

    /**
     * Set a generic query parameter.
     */
    public function where(string $field, mixed $value): static
    {
        if (is_array($value)) {
            $value = implode('|', $value);
        }
        $this->parameters[$field] = $value;
        return $this;
    }

    /**
     * Set multiple parameters at once.
     *
     * @param array<string, mixed> $parameters
     */
    public function withParameters(array $parameters): static
    {
        foreach ($parameters as $key => $value) {
            $this->where($key, $value);
        }
        return $this;
    }

    /**
     * Set aggregation parameters.
     *
     * @param array<string, mixed> $aggregations
     */
    public function aggregations(array $aggregations): static
    {
        $this->parameters['aggregation'] = json_encode($aggregations);
        return $this;
    }

    /**
     * Add a text search query.
     */
    public function search(string $query): static
    {
        $this->parameters['q'] = $query;
        return $this;
    }

    /**
     * Alias for search method.
     */
    public function query(string $query): static
    {
        return $this->search($query);
    }

    /**
     * Find a single record by ID.
     *
     * @return array<string, mixed>
     */
    public function find(int|string $id): array
    {
        $method = $this->endpoint;
        return $this->client->$method($id, $this->parameters);
    }

    /**
     * Get all records matching the current query.
     *
     * @return array<string, mixed>
     */
    public function get(): array
    {
        $method = $this->endpoint . 's'; // pluralize
        return $this->client->$method($this->parameters);
    }

    /**
     * Get the first record matching the current query.
     *
     * @return array<string, mixed>|null
     */
    public function first(): ?array
    {
        $this->size(1);
        $results = $this->get();

        return $results['records'][0] ?? null;
    }

    /**
     * Get the count of records matching the current query.
     */
    public function count(): int
    {
        $results = $this->get();
        return $results['info']['totalrecords'] ?? 0;
    }

    /**
     * Alias for get method.
     *
     * @return array<string, mixed>
     */
    public function all(): array
    {
        return $this->get();
    }

    /**
     * Clone the builder.
     */
    public function clone(): static
    {
        return clone $this;
    }

    /**
     * Reset all parameters.
     */
    public function reset(): static
    {
        $this->parameters = [];
        $this->id = null;
        return $this;
    }
}