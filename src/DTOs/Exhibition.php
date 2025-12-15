<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\DTOs;

use Carbon\Carbon;

class Exhibition
{
    /**
     * Create a new exhibition instance.
     *
     * @param array<string, mixed> $data
     */
    public function __construct(
        public readonly int $id,
        public readonly string $exhibitionid,
        public readonly ?string $title,
        public readonly ?string $description,
        public readonly ?string $shortdescription,
        public readonly ?string $begindate,
        public readonly ?string $enddate,
        public readonly ?string $temporalorder,
        public readonly ?string $status,
        public readonly int $objectcount,
        public readonly ?string $url,
        public readonly ?string $textilesurl,
        public readonly ?string $primaryimageurl,
        public readonly array $venues,
        public readonly array $galleries,
        public readonly array $publications,
        public readonly array $images,
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
            exhibitionid: $data['exhibitionid'] ?? '',
            title: $data['title'] ?? null,
            description: $data['description'] ?? null,
            shortdescription: $data['shortdescription'] ?? null,
            begindate: $data['begindate'] ?? null,
            enddate: $data['enddate'] ?? null,
            temporalorder: $data['temporalorder'] ?? null,
            status: $data['status'] ?? null,
            objectcount: $data['objectcount'] ?? 0,
            url: $data['url'] ?? null,
            textilesurl: $data['textilesurl'] ?? null,
            primaryimageurl: $data['primaryimageurl'] ?? null,
            venues: $data['venues'] ?? [],
            galleries: $data['galleries'] ?? [],
            publications: $data['publications'] ?? [],
            images: $data['images'] ?? [],
            data: $data
        );
    }

    /**
     * Get the display title.
     */
    public function getDisplayTitle(): string
    {
        return $this->title ?? 'Untitled Exhibition';
    }

    /**
     * Check if exhibition is currently active.
     */
    public function isCurrent(): bool
    {
        return $this->status === 'current';
    }

    /**
     * Check if exhibition is past.
     */
    public function isPast(): bool
    {
        return $this->status === 'past';
    }

    /**
     * Check if exhibition is upcoming.
     */
    public function isUpcoming(): bool
    {
        return $this->status === 'upcoming';
    }

    /**
     * Check if exhibition has an image.
     */
    public function hasImage(): bool
    {
        return $this->primaryimageurl !== null || !empty($this->images);
    }

    /**
     * Get begin date as Carbon instance.
     */
    public function getBeginDate(): ?Carbon
    {
        return $this->begindate ? Carbon::parse($this->begindate) : null;
    }

    /**
     * Get end date as Carbon instance.
     */
    public function getEndDate(): ?Carbon
    {
        return $this->enddate ? Carbon::parse($this->enddate) : null;
    }

    /**
     * Get formatted date range.
     */
    public function getDateRange(): string
    {
        $begin = $this->getBeginDate();
        $end = $this->getEndDate();

        if (!$begin && !$end) {
            return 'Dates TBD';
        }

        if ($begin && !$end) {
            return 'Starting ' . $begin->format('F j, Y');
        }

        if (!$begin && $end) {
            return 'Through ' . $end->format('F j, Y');
        }

        // Both dates exist
        if ($begin->year === $end->year) {
            if ($begin->month === $end->month) {
                return $begin->format('F j') . '–' . $end->format('j, Y');
            }
            return $begin->format('F j') . ' – ' . $end->format('F j, Y');
        }

        return $begin->format('F j, Y') . ' – ' . $end->format('F j, Y');
    }

    /**
     * Get primary venue name.
     */
    public function getPrimaryVenue(): ?string
    {
        return $this->venues[0]['name'] ?? null;
    }

    /**
     * Get gallery names.
     *
     * @return array<string>
     */
    public function getGalleryNames(): array
    {
        return array_map(fn($gallery) => $gallery['name'] ?? '', $this->galleries);
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