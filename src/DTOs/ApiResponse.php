<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\DTOs;

class ApiResponse
{
    /**
     * Create a new API response instance.
     *
     * @param array<string, mixed> $info
     * @param array<int, array<string, mixed>> $records
     * @param array<string, mixed> $aggregations
     */
    public function __construct(
        public readonly array $info,
        public readonly array $records,
        public readonly array $aggregations = []
    ) {
    }

    /**
     * Create from API response array.
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            info: $data['info'] ?? [],
            records: $data['records'] ?? [],
            aggregations: $data['aggregations'] ?? []
        );
    }

    /**
     * Get the total number of records.
     */
    public function getTotalRecords(): int
    {
        return $this->info['totalrecords'] ?? 0;
    }

    /**
     * Get the total number of pages.
     */
    public function getTotalPages(): int
    {
        return $this->info['pages'] ?? 0;
    }

    /**
     * Get the current page.
     */
    public function getCurrentPage(): int
    {
        return $this->info['page'] ?? 1;
    }

    /**
     * Get the next URL.
     */
    public function getNextUrl(): ?string
    {
        return $this->info['next'] ?? null;
    }

    /**
     * Get the previous URL.
     */
    public function getPreviousUrl(): ?string
    {
        return $this->info['prev'] ?? null;
    }

    /**
     * Check if there is a next page.
     */
    public function hasNextPage(): bool
    {
        return $this->getNextUrl() !== null;
    }

    /**
     * Check if there is a previous page.
     */
    public function hasPreviousPage(): bool
    {
        return $this->getPreviousUrl() !== null;
    }

    /**
     * Convert to array.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'info' => $this->info,
            'records' => $this->records,
            'aggregations' => $this->aggregations,
        ];
    }
}