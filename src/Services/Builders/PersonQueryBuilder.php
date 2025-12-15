<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Services\Builders;

use Harvardartmuseums\HamAPI\Services\QueryBuilder;

class PersonQueryBuilder extends QueryBuilder
{
    protected string $endpoint = 'person';

    /**
     * Filter by person name.
     */
    public function name(string $name): static
    {
        return $this->where('name', $name);
    }

    /**
     * Filter by display name.
     */
    public function displayName(string $displayName): static
    {
        return $this->where('displayname', $displayName);
    }

    /**
     * Filter by birth place.
     */
    public function birthPlace(string $birthPlace): static
    {
        return $this->where('birthplace', $birthPlace);
    }

    /**
     * Filter by death place.
     */
    public function deathPlace(string $deathPlace): static
    {
        return $this->where('deathplace', $deathPlace);
    }

    /**
     * Filter by role.
     *
     * @param string|array<string> $role
     */
    public function role(string|array $role): static
    {
        return $this->where('role', $role);
    }

    /**
     * Filter by gender.
     */
    public function gender(string $gender): static
    {
        return $this->where('gender', $gender);
    }

    /**
     * Filter by culture.
     *
     * @param string|array<string> $culture
     */
    public function culture(string|array $culture): static
    {
        return $this->where('culture', $culture);
    }

    /**
     * Filter by person ID.
     */
    public function personId(int $personId): static
    {
        return $this->where('personid', $personId);
    }

    /**
     * Filter by ULAN ID.
     */
    public function ulanId(string $ulanId): static
    {
        return $this->where('ulanid', $ulanId);
    }

    /**
     * Filter by VIAF ID.
     */
    public function viafId(string $viafId): static
    {
        return $this->where('viafid', $viafId);
    }

    /**
     * Filter by Wikipedia ID.
     */
    public function wikipediaId(string $wikipediaId): static
    {
        return $this->where('wikipediaid', $wikipediaId);
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
     * Filter by date range.
     */
    public function dateRange(int $yearStart, int $yearEnd): static
    {
        return $this->where('yearmade', $yearStart . '-' . $yearEnd);
    }
}