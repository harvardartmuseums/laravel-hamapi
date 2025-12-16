<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Traits;

use Harvardartmuseums\HamAPI\HamApi;

/**
 * Provides backward compatibility with the old HamClass methods.
 */
trait BackwardCompatibility
{
    protected string $endpoint;
    protected ?int $id = null;
    protected int $size = 1000;
    protected string $sort = '';
    protected string $sortorder = '';
    protected string $from = '';
    protected string $q = '';
    protected array $fields = [];
    protected array $facet = [];
    protected string $operator = 'OR';
    protected array $usedby = [];

    public function limit($limit = 50): static
    {
        $this->size = $limit;
        return $this;
    }

    public function sort($sort = ''): static
    {
        $this->sort = $sort;
        return $this;
    }

    public function usedby($group = ''): static
    {
        if ($group) {
            $this->usedby = ['group' => $group];
        }
        return $this;
    }

    public function operator($operator = 'AND'): static
    {
        $this->operator = $operator;
        return $this;
    }

    public function sortorder($sortorder = ''): static
    {
        $this->sortorder = $sortorder;
        return $this;
    }

    public function from($from = ''): static
    {
        $this->from = $from;
        return $this;
    }

    public function find($id = '')
    {
        $this->id = $id;
        $hamAPI = new HamApi();
        $result = $hamAPI->getDatas($this);
        $this->cleanFilters();
        return $result;
    }

    public function findCount()
    {
        $hamAPI = new HamApi();
        $result = $hamAPI->getDatas($this, true);
        $this->cleanFilters();
        return $result;
    }

    public function query($q = ''): static
    {
        $this->q = $q;
        return $this;
    }

    public function cleanFilters(): void
    {
        $this->sort = '';
        $this->sortorder = '';
        $this->usedby = [];
        $this->from = '';
        $this->size = 1000;
        $this->id = null;
        $this->operator = 'OR';
        $this->facet = [];
        $this->fields = [];
        $this->q = '';
    }
}