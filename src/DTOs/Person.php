<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\DTOs;

class Person
{
    /**
     * Create a new person instance.
     *
     * @param array<string, mixed> $data
     */
    public function __construct(
        public readonly int $id,
        public readonly string $personid,
        public readonly ?string $name,
        public readonly ?string $displayname,
        public readonly ?string $alphasort,
        public readonly ?string $birthplace,
        public readonly ?string $deathplace,
        public readonly ?string $gender,
        public readonly ?string $culture,
        public readonly ?string $displaydate,
        public readonly ?int $datebegin,
        public readonly ?int $dateend,
        public readonly ?string $ulanid,
        public readonly ?string $viafid,
        public readonly ?string $wikipediaid,
        public readonly ?string $url,
        public readonly int $objectcount,
        public readonly array $roles,
        public readonly array $data
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
            id: $data['id'] ?? 0,
            personid: $data['personid'] ?? '',
            name: $data['name'] ?? null,
            displayname: $data['displayname'] ?? null,
            alphasort: $data['alphasort'] ?? null,
            birthplace: $data['birthplace'] ?? null,
            deathplace: $data['deathplace'] ?? null,
            gender: $data['gender'] ?? null,
            culture: $data['culture'] ?? null,
            displaydate: $data['displaydate'] ?? null,
            datebegin: isset($data['datebegin']) ? (int) $data['datebegin'] : null,
            dateend: isset($data['dateend']) ? (int) $data['dateend'] : null,
            ulanid: $data['ulanid'] ?? null,
            viafid: $data['viafid'] ?? null,
            wikipediaid: $data['wikipediaid'] ?? null,
            url: $data['url'] ?? null,
            objectcount: $data['objectcount'] ?? 0,
            roles: $data['roles'] ?? [],
            data: $data
        );
    }

    /**
     * Get the display name or regular name.
     */
    public function getDisplayName(): string
    {
        return $this->displayname ?? $this->name ?? 'Unknown';
    }

    /**
     * Check if person has a specific role.
     */
    public function hasRole(string $role): bool
    {
        return in_array($role, $this->roles);
    }

    /**
     * Check if person is an artist.
     */
    public function isArtist(): bool
    {
        return $this->hasRole('Artist');
    }

    /**
     * Get life dates as a formatted string.
     */
    public function getLifeDates(): ?string
    {
        if ($this->displaydate) {
            return $this->displaydate;
        }

        if ($this->datebegin && $this->dateend) {
            return "{$this->datebegin}-{$this->dateend}";
        }

        if ($this->datebegin) {
            return "b. {$this->datebegin}";
        }

        if ($this->dateend) {
            return "d. {$this->dateend}";
        }

        return null;
    }

    /**
     * Convert to array.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return $this->data;
    }
}