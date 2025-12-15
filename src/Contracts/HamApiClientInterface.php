<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Contracts;

interface HamApiClientInterface
{
    /**
     * Get objects from the API.
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function objects(array $params = []): array;

    /**
     * Get a single object by ID.
     *
     * @param int|string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function object(int|string $id, array $params = []): array;

    /**
     * Get exhibitions from the API.
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function exhibitions(array $params = []): array;

    /**
     * Get a single exhibition by ID.
     *
     * @param int|string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function exhibition(int|string $id, array $params = []): array;

    /**
     * Get publications from the API.
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function publications(array $params = []): array;

    /**
     * Get a single publication by ID.
     *
     * @param int|string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function publication(int|string $id, array $params = []): array;

    /**
     * Get galleries from the API.
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function galleries(array $params = []): array;

    /**
     * Get a single gallery by ID.
     *
     * @param int|string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function gallery(int|string $id, array $params = []): array;

    /**
     * Get people from the API.
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function people(array $params = []): array;

    /**
     * Get a single person by ID.
     *
     * @param int|string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function person(int|string $id, array $params = []): array;

    /**
     * Get classifications from the API.
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function classifications(array $params = []): array;

    /**
     * Get a single classification by ID.
     *
     * @param int|string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function classification(int|string $id, array $params = []): array;

    /**
     * Get periods from the API.
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function periods(array $params = []): array;

    /**
     * Get a single period by ID.
     *
     * @param int|string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function period(int|string $id, array $params = []): array;

    /**
     * Get cultures from the API.
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function cultures(array $params = []): array;

    /**
     * Get a single culture by ID.
     *
     * @param int|string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function culture(int|string $id, array $params = []): array;

    /**
     * Get mediums from the API.
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function mediums(array $params = []): array;

    /**
     * Get a single medium by ID.
     *
     * @param int|string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function medium(int|string $id, array $params = []): array;

    /**
     * Get techniques from the API.
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function techniques(array $params = []): array;

    /**
     * Get a single technique by ID.
     *
     * @param int|string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function technique(int|string $id, array $params = []): array;

    /**
     * Get worktypes from the API.
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function worktypes(array $params = []): array;

    /**
     * Get a single worktype by ID.
     *
     * @param int|string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function worktype(int|string $id, array $params = []): array;

    /**
     * Get places from the API.
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function places(array $params = []): array;

    /**
     * Get a single place by ID.
     *
     * @param int|string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function place(int|string $id, array $params = []): array;

    /**
     * Get centuries from the API.
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function centuries(array $params = []): array;

    /**
     * Get a single century by ID.
     *
     * @param int|string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function century(int|string $id, array $params = []): array;

    /**
     * Get colors from the API.
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function colors(array $params = []): array;

    /**
     * Get a single color by ID.
     *
     * @param int|string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function color(int|string $id, array $params = []): array;

    /**
     * Get spectra from the API.
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function spectra(array $params = []): array;

    /**
     * Get a single spectrum by ID.
     *
     * @param int|string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function spectrum(int|string $id, array $params = []): array;

    /**
     * Get groups from the API.
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function groups(array $params = []): array;

    /**
     * Get a single group by ID.
     *
     * @param int|string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function group(int|string $id, array $params = []): array;

    /**
     * Execute a generic API request.
     *
     * @param string $endpoint
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function get(string $endpoint, array $params = []): array;
}