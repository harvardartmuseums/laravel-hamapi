<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Services;

use Harvardartmuseums\HamAPI\Contracts\HamApiClientInterface;
use Harvardartmuseums\HamAPI\Services\Builders\ObjectQueryBuilder;

class BrowseService
{
    protected HamApiClientInterface $client;

    public function __construct(HamApiClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Search objects with various filters.
     *
     * @param array<string, mixed> $filters
     * @param int $offset
     * @param int $limit
     * @param string $orderBy
     * @param string $direction
     * @return array<string, mixed>
     */
    public function search(
        array $filters,
        int $offset = 0,
        int $limit = 12,
        string $orderBy = 'rank',
        string $direction = 'asc'
    ): array {
        $builder = new ObjectQueryBuilder($this->client);

        // Set pagination
        $builder->limit($limit)
            ->offset($offset)
            ->sort($orderBy)
            ->sortOrder($direction);

        // Handle search query with special cases
        if (!empty($filters['q'])) {
            $query = $filters['q'];

            // Try exact gallery match first if on view
            if (!empty($filters['onview'])) {
                $galleryResult = $this->tryGallerySearch($builder, $filters);
                if ($galleryResult && $galleryResult['info']['totalrecords'] > 0) {
                    return $galleryResult;
                }
            }

            // Try exact object number match
            $objectNumberResult = $this->tryObjectNumberSearch($builder, $filters);
            if ($objectNumberResult && $objectNumberResult['info']['totalrecords'] > 0) {
                return $objectNumberResult;
            }

            // Fall back to keyword search
            $builder->keyword($query);
        }

        // Apply all filters
        $this->applyFilters($builder, $filters);

        return $builder->get();
    }

    /**
     * Try searching by gallery number.
     *
     * @param ObjectQueryBuilder $builder
     * @param array<string, mixed> $filters
     * @return array<string, mixed>|null
     */
    protected function tryGallerySearch(ObjectQueryBuilder $builder, array $filters): ?array
    {
        $tempBuilder = clone $builder;
        $tempBuilder->gallery($filters['q']);

        // Apply other filters
        $this->applyFilters($tempBuilder, $filters, ['q', 'gallery']);

        $result = $tempBuilder->get();
        if ($result['info']['totalrecords'] > 0) {
            return $result;
        }

        return null;
    }

    /**
     * Try searching by object number.
     *
     * @param ObjectQueryBuilder $builder
     * @param array<string, mixed> $filters
     * @return array<string, mixed>|null
     */
    protected function tryObjectNumberSearch(ObjectQueryBuilder $builder, array $filters): ?array
    {
        $tempBuilder = clone $builder;
        $tempBuilder->objectNumber($filters['q']);

        // Apply other filters
        $this->applyFilters($tempBuilder, $filters, ['q']);

        $result = $tempBuilder->get();
        if ($result['info']['totalrecords'] > 0) {
            return $result;
        }

        return null;
    }

    /**
     * Apply filters to the query builder.
     *
     * @param ObjectQueryBuilder $builder
     * @param array<string, mixed> $filters
     * @param array<string> $exclude
     */
    protected function applyFilters(ObjectQueryBuilder $builder, array $filters, array $exclude = []): void
    {
        $filterMap = [
            'group' => 'group',
            'classification' => 'classification',
            'technique' => 'technique',
            'medium' => 'medium',
            'place' => 'place',
            'worktype' => 'worktype',
            'culture' => 'culture',
            'century' => 'century',
            'person' => 'person',
            'period' => 'period',
            'gallery' => 'gallery',
            'exhibition' => 'exhibition',
            'color' => 'color',
        ];

        foreach ($filterMap as $filterKey => $method) {
            if (!empty($filters[$filterKey]) && !in_array($filterKey, $exclude)) {
                $builder->$method($filters[$filterKey]);
            }
        }

        // Handle special filters
        if (!empty($filters['onview']) && !in_array('onview', $exclude)) {
            $builder->onView(true);
        }

        if (!empty($filters['hasimage'])) {
            $builder->hasImage(true);
        }

        if (!empty($filters['custom']) && is_array($filters['custom'])) {
            $builder->custom($filters['custom']);
        }
    }

    /**
     * Get objects for a specific gallery.
     *
     * @param string|int $gallery
     * @param array<string, mixed> $options
     * @return array<string, mixed>
     */
    public function browseGallery(string|int $gallery, array $options = []): array
    {
        $builder = new ObjectQueryBuilder($this->client);

        $builder->gallery($gallery)
            ->limit($options['limit'] ?? 12)
            ->offset($options['offset'] ?? 0)
            ->sort($options['sort'] ?? 'rank')
            ->sortOrder($options['direction'] ?? 'asc');

        if (!empty($options['hasimage'])) {
            $builder->hasImage(true);
        }

        return $builder->get();
    }

    /**
     * Get objects for a specific exhibition.
     *
     * @param string|int $exhibition
     * @param array<string, mixed> $options
     * @return array<string, mixed>
     */
    public function browseExhibition(string|int $exhibition, array $options = []): array
    {
        $builder = new ObjectQueryBuilder($this->client);

        $builder->exhibition($exhibition)
            ->limit($options['limit'] ?? 12)
            ->offset($options['offset'] ?? 0)
            ->sort($options['sort'] ?? 'rank')
            ->sortOrder($options['direction'] ?? 'asc');

        if (!empty($options['hasimage'])) {
            $builder->hasImage(true);
        }

        return $builder->get();
    }

    /**
     * Get objects by a specific person.
     *
     * @param string|int $person
     * @param array<string, mixed> $options
     * @return array<string, mixed>
     */
    public function browsePerson(string|int $person, array $options = []): array
    {
        $builder = new ObjectQueryBuilder($this->client);

        $builder->person($person)
            ->limit($options['limit'] ?? 12)
            ->offset($options['offset'] ?? 0)
            ->sort($options['sort'] ?? 'rank')
            ->sortOrder($options['direction'] ?? 'asc');

        if (!empty($options['hasimage'])) {
            $builder->hasImage(true);
        }

        if (!empty($options['role'])) {
            $builder->where('role', $options['role']);
        }

        return $builder->get();
    }

    /**
     * Get objects on view.
     *
     * @param array<string, mixed> $options
     * @return array<string, mixed>
     */
    public function browseOnView(array $options = []): array
    {
        $builder = new ObjectQueryBuilder($this->client);

        $builder->onView(true)
            ->limit($options['limit'] ?? 12)
            ->offset($options['offset'] ?? 0)
            ->sort($options['sort'] ?? 'gallery')
            ->sortOrder($options['direction'] ?? 'asc');

        if (!empty($options['hasimage'])) {
            $builder->hasImage(true);
        }

        if (!empty($options['classification'])) {
            $builder->classification($options['classification']);
        }

        return $builder->get();
    }

    /**
     * Get random objects.
     *
     * @param int $count
     * @param array<string, mixed> $filters
     * @return array<string, mixed>
     */
    public function random(int $count = 12, array $filters = []): array
    {
        $builder = new ObjectQueryBuilder($this->client);

        $builder->limit($count)
            ->sort('random');

        // Apply any additional filters
        $this->applyFilters($builder, $filters);

        return $builder->get();
    }
}