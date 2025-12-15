<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\DTOs;

class Publication
{
    /**
     * Create a new publication instance.
     *
     * @param array<string, mixed> $data
     */
    public function __construct(
        public readonly int $id,
        public readonly string $publicationid,
        public readonly ?string $title,
        public readonly ?string $citation,
        public readonly ?string $publicationtype,
        public readonly ?string $publicationplace,
        public readonly ?string $publicationdate,
        public readonly ?int $publicationyear,
        public readonly ?string $format,
        public readonly ?string $publisher,
        public readonly ?string $volume,
        public readonly ?string $series,
        public readonly ?string $isbn,
        public readonly ?string $issn,
        public readonly ?string $url,
        public readonly int $objectcount,
        public readonly array $people,
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
            publicationid: $data['publicationid'] ?? '',
            title: $data['title'] ?? null,
            citation: $data['citation'] ?? null,
            publicationtype: $data['publicationtype'] ?? null,
            publicationplace: $data['publicationplace'] ?? null,
            publicationdate: $data['publicationdate'] ?? null,
            publicationyear: isset($data['publicationyear']) ? (int) $data['publicationyear'] : null,
            format: $data['format'] ?? null,
            publisher: $data['publisher'] ?? null,
            volume: $data['volume'] ?? null,
            series: $data['series'] ?? null,
            isbn: $data['isbn'] ?? null,
            issn: $data['issn'] ?? null,
            url: $data['url'] ?? null,
            objectcount: $data['objectcount'] ?? 0,
            people: $data['people'] ?? [],
            data: $data
        );
    }

    /**
     * Get the display title.
     */
    public function getDisplayTitle(): string
    {
        return $this->title ?? 'Untitled Publication';
    }

    /**
     * Get authors.
     *
     * @return array<array<string, mixed>>
     */
    public function getAuthors(): array
    {
        return array_filter($this->people, function ($person) {
            $role = $person['role'] ?? '';
            return in_array($role, ['Author', 'Editor', 'Contributor']);
        });
    }

    /**
     * Get primary author name.
     */
    public function getPrimaryAuthor(): ?string
    {
        $authors = $this->getAuthors();
        return !empty($authors) ? ($authors[0]['name'] ?? null) : null;
    }

    /**
     * Get formatted authors string.
     */
    public function getAuthorsString(): string
    {
        $authors = array_map(fn($author) => $author['name'] ?? '', $this->getAuthors());

        if (count($authors) === 0) {
            return '';
        }

        if (count($authors) === 1) {
            return $authors[0];
        }

        if (count($authors) === 2) {
            return implode(' and ', $authors);
        }

        $last = array_pop($authors);
        return implode(', ', $authors) . ', and ' . $last;
    }

    /**
     * Check if publication is a book.
     */
    public function isBook(): bool
    {
        return $this->publicationtype === 'Book' || $this->publicationtype === 'Monograph';
    }

    /**
     * Check if publication is a journal.
     */
    public function isJournal(): bool
    {
        return $this->publicationtype === 'Journal' || $this->publicationtype === 'Article';
    }

    /**
     * Check if publication is a catalog.
     */
    public function isCatalog(): bool
    {
        return $this->publicationtype === 'Exhibition Catalogue' ||
               $this->publicationtype === 'Collection Catalogue';
    }

    /**
     * Get formatted citation.
     */
    public function getFormattedCitation(): string
    {
        if ($this->citation) {
            return $this->citation;
        }

        // Build basic citation
        $parts = [];

        if ($author = $this->getPrimaryAuthor()) {
            $parts[] = $author;
        }

        if ($this->title) {
            $parts[] = "<i>{$this->title}</i>";
        }

        if ($this->publicationplace && $this->publisher) {
            $parts[] = "{$this->publicationplace}: {$this->publisher}";
        } elseif ($this->publisher) {
            $parts[] = $this->publisher;
        }

        if ($this->publicationyear) {
            $parts[] = $this->publicationyear;
        }

        return implode('. ', $parts) . '.';
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