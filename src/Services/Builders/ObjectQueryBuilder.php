<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Services\Builders;

use Harvardartmuseums\HamAPI\Services\QueryBuilder;

class ObjectQueryBuilder extends QueryBuilder
{
    protected string $endpoint = 'object';

    /**
     * Filter by classification.
     *
     * @param string|array<string> $classification
     */
    public function classification(string|array $classification): static
    {
        return $this->where('classification', $classification);
    }

    /**
     * Filter by gallery.
     *
     * @param string|array<string>|int|array<int> $gallery
     */
    public function gallery(string|array|int $gallery): static
    {
        return $this->where('gallery', $gallery);
    }

    /**
     * Filter by century.
     *
     * @param string|array<string> $century
     */
    public function century(string|array $century): static
    {
        return $this->where('century', $century);
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
     * Filter by person (ID or name).
     *
     * @param string|array<string>|int|array<int> $person
     */
    public function person(string|array|int $person): static
    {
        return $this->where('person', $person);
    }

    /**
     * Filter by exhibition ID.
     */
    public function exhibition(int|string $exhibitionId): static
    {
        return $this->where('exhibition', $exhibitionId);
    }

    /**
     * Filter by group name.
     */
    public function group(string $group): static
    {
        return $this->where('group', $group);
    }

    /**
     * Filter by exact title.
     */
    public function exactTitle(string $title): static
    {
        return $this->where('title', $title);
    }

    /**
     * Filter by object number.
     */
    public function objectNumber(string $objectNumber): static
    {
        return $this->where('objectnumber', $objectNumber);
    }

    /**
     * Filter by keyword.
     */
    public function keyword(string $keyword): static
    {
        return $this->where('keyword', $keyword);
    }

    /**
     * Filter by technique.
     *
     * @param string|array<string> $technique
     */
    public function technique(string|array $technique): static
    {
        return $this->where('technique', $technique);
    }

    /**
     * Filter by medium.
     *
     * @param string|array<string> $medium
     */
    public function medium(string|array $medium): static
    {
        return $this->where('medium', $medium);
    }

    /**
     * Filter by place.
     *
     * @param string|array<string> $place
     */
    public function place(string|array $place): static
    {
        return $this->where('place', $place);
    }

    /**
     * Filter by worktype.
     *
     * @param string|array<string> $worktype
     */
    public function worktype(string|array $worktype): static
    {
        return $this->where('worktype', $worktype);
    }

    /**
     * Filter by color.
     *
     * @param string|array<string> $color
     */
    public function color(string|array $color): static
    {
        return $this->where('color', $color);
    }

    /**
     * Filter by period.
     *
     * @param string|array<string> $period
     */
    public function period(string|array $period): static
    {
        return $this->where('period', $period);
    }

    /**
     * Filter by related object.
     */
    public function relatedTo(string $objectId): static
    {
        return $this->where('relatedto', $objectId);
    }

    /**
     * Filter to objects on view.
     */
    public function onView(bool $onView = true): static
    {
        if ($onView) {
            return $this->where('gallery', 'any');
        }
        return $this;
    }

    /**
     * Filter to objects with images.
     */
    public function hasImage(bool $hasImage = true): static
    {
        return $this->where('hasimage', $hasImage ? 1 : 0);
    }

    /**
     * Filter by date range.
     */
    public function dateRange(int $yearStart, int $yearEnd): static
    {
        return $this->where('yearmade', $yearStart . '-' . $yearEnd);
    }

    /**
     * Filter by accession year.
     */
    public function accessionYear(int $year): static
    {
        return $this->where('accessionyear', $year);
    }

    /**
     * Filter by verification level.
     *
     * @param string|array<string> $level
     */
    public function verificationLevel(string|array $level): static
    {
        return $this->where('verificationlevel', $level);
    }

    /**
     * Filter by department.
     *
     * @param string|array<string> $department
     */
    public function department(string|array $department): static
    {
        return $this->where('department', $department);
    }

    /**
     * Filter by division.
     *
     * @param string|array<string> $division
     */
    public function division(string|array $division): static
    {
        return $this->where('division', $division);
    }

    /**
     * Filter by contact.
     *
     * @param string|array<string> $contact
     */
    public function contact(string|array $contact): static
    {
        return $this->where('contact', $contact);
    }

    /**
     * Filter to objects with conservation reports.
     */
    public function hasConservationReport(bool $hasReport = true): static
    {
        return $this->where('hasconservationreport', $hasReport ? 1 : 0);
    }

    /**
     * Filter to objects with technical reports.
     */
    public function hasTechnicalReport(bool $hasReport = true): static
    {
        return $this->where('hastechnicalreport', $hasReport ? 1 : 0);
    }

    /**
     * Filter to objects used by a specific group.
     */
    public function usedBy(string $group): static
    {
        return $this->where('usedby', ['group' => $group]);
    }

    /**
     * Add custom parameters.
     *
     * @param array<string, mixed> $custom
     */
    public function custom(array $custom): static
    {
        foreach ($custom as $key => $value) {
            $this->where($key, $value);
        }
        return $this;
    }
}