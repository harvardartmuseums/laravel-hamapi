<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\DTOs;

class ArtObject
{
    /**
     * Create a new art object instance.
     *
     * @param array<string, mixed> $data
     */
    public function __construct(
        public readonly int $id,
        public readonly string $objectnumber,
        public readonly ?string $title,
        public readonly ?string $dated,
        public readonly ?string $datebegin,
        public readonly ?string $dateend,
        public readonly ?string $classification,
        public readonly ?string $medium,
        public readonly ?string $technique,
        public readonly ?string $department,
        public readonly ?string $division,
        public readonly ?string $creditline,
        public readonly ?string $description,
        public readonly ?string $provenance,
        public readonly ?string $commentary,
        public readonly ?string $labeltext,
        public readonly ?string $imageurl,
        public readonly ?string $primaryimageurl,
        public readonly array $images,
        public readonly array $people,
        public readonly array $colors,
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
            objectnumber: $data['objectnumber'] ?? '',
            title: $data['title'] ?? null,
            dated: $data['dated'] ?? null,
            datebegin: $data['datebegin'] ?? null,
            dateend: $data['dateend'] ?? null,
            classification: $data['classification'] ?? null,
            medium: $data['medium'] ?? null,
            technique: $data['technique'] ?? null,
            department: $data['department'] ?? null,
            division: $data['division'] ?? null,
            creditline: $data['creditline'] ?? null,
            description: $data['description'] ?? null,
            provenance: $data['provenance'] ?? null,
            commentary: $data['commentary'] ?? null,
            labeltext: $data['labeltext'] ?? null,
            imageurl: $data['imageurl'] ?? null,
            primaryimageurl: $data['primaryimageurl'] ?? null,
            images: $data['images'] ?? [],
            people: $data['people'] ?? [],
            colors: $data['colors'] ?? [],
            data: $data
        );
    }

    /**
     * Get the display title.
     */
    public function getDisplayTitle(): string
    {
        return $this->title ?? 'Untitled';
    }

    /**
     * Check if the object has an image.
     */
    public function hasImage(): bool
    {
        return $this->primaryimageurl !== null;
    }

    /**
     * Get all artists.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getArtists(): array
    {
        return array_filter($this->people, function ($person) {
            return ($person['role'] ?? '') === 'Artist';
        });
    }

    /**
     * Get the primary artist name.
     */
    public function getPrimaryArtist(): ?string
    {
        $artists = $this->getArtists();
        return !empty($artists) ? ($artists[0]['name'] ?? null) : null;
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