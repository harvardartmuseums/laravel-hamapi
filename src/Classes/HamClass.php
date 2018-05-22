<?php

namespace Harvardartmuseums\HamAPI\Classes;

use Harvardartmuseums\HamAPI\HamApi;

class HamClass
{
    public $sort = '';
    public $sortorder = '';
    public $from = '';
    public $size = 1000;
    public $i = '';
    public $id = null;
    public $usedby = [];
    public $operator = 'OR';
    public $next = false;
    public $previous = false;

  //facet=[FIELD NAME or comma separated list of fields]
    public $facet = [];

  //fields=[comma separated list of fields]
    public $fields = [];

    public $exact_match_fields = [];

  //q=[FIELD]:[VALUE]
    public $q = '';

    public function limit($limit = 50)
    {
        $this->size = $limit;
        return $this;
    }

    public function sort($sort = '')
    {
        $this->sort = $sort;
        return $this;
    }

    public function usedby($group = '')
    {
        if ($group) {
            $this->usedby = ['group' => $group];
        }
        return $this;
    }

    public function operator($operator = 'AND')
    {
        $this->operator = $operator;
        return $this;
    }

    public function sortorder($sortorder = '')
    {
        $this->sortorder = $sortorder;
        return $this;
    }

    public function from($from = '')
    {
        $this->from = $from;
        return $this;
    }

    public function i($i = '')
    {
        $this->i = '';
        return $this;
    }

    public function find($id = '')
    {
        $this->id = $id;
        $hamAPI = new HamApi();
        $result = $hamAPI->getDatas($this);
        $this->cleanFilters();
        $result = \Harvardartmuseums\HamAPI\VarnishHelper::varnishify($result);
        return $result;
    }

    public function findCount()
    {
        $hamAPI = new HamApi();
        $result = $hamAPI->getDatas($this, true);

        $this->cleanFilters();
        $result = \Harvardartmuseums\HamAPI\VarnishHelper::varnishify($result);
        return $result;
    }

    public function query($q = '')
    {
        $this->q = $q;
        return $this;
    }

  #This should be called after the search is performed
    public function cleanFilters()
    {
        #Set attributes with their default values

        $this->sort = '';
        $this->sortorder = '';
        $this->usedby = [];
        $this->from = '';
        $this->size = 1000;
        $this->i = '';
        $this->id = null;
        $this->operator = 'OR';
        $this->facet = [];
        $this->fields = [];
        $this->q = '';
    }
}
