<?php

namespace Harvardartmuseums\HamAPI\Classes;

use HamAPI\HamApi;

class HamObject extends HamClass
{

    public $endpoint = 'object';

  //gallery=[GALLERY NUMBER or comma separated list of gallery numbers or “any”]
    public $gallery = [];

  //century=[CENTURY or comma separated list of centuries]
    public $century = [];

  //classification=[CLASSIFICATION or comma separated list of classifications]
    public $classification = [];

  //culture=[CULTURE or comma separated list of cultures]
    public $culture = [];

  //Definition of custom filters (array of arrays)
    public $custom = [];

  //person=[PERSON ID or PERSON NAME]
    public $person = [];

  //exhibition=[EXHIBITION ID]
    public $exhibition = null;

  //group=[GROUP NAME]
    public $group = null;

  //[EXACT URL ENCODED TITLE]
    public $exact_title = null;

  //[OBJECT NUMBER]
    public $objectnumber = null;

  //[KEYWORD]
    public $keyword = null;

  //group=[GROUP NAME]
    public $relatedto = null;

    public $hasimage = 0;

    public $search_fields = [
    'title','description','objectnumber', 'objectid',
    ];

    public $exact_match_fields = [
    'objectnumber'
    ];

    public function group($group = '')
    {
        $this->group = rawurlencode($group);
        return $this;
    }

    public function custom($custom = [])
    {
        $this->custom = $custom;
        return $this;
    }

    public function exhibition($exhibitionId = '')
    {
        $this->exhibition = $exhibitionId;
        return $this;
    }

    public function classification($classification = [])
    {
        $this->classification = $classification;
        return $this;
    }

    public function gallery($gallery = [])
    {
        $this->gallery = $gallery;
        return $this;
    }

    public function century($century = [])
    {
        $this->century = $century;
        return $this;
    }

    public function culture($culture = [])
    {
        $this->culture = $culture;
        return $this;
    }

    public function exact_title($exact_title = [])
    {
        $this->exact_title = urlencode($exact_title);
        return $this;
    }

    public function objectnumber($objectnumber = [])
    {
        $this->objectnumber = urlencode($objectnumber);
        return $this;
    }

    public function keyword($keyword = [])
    {
        $this->keyword = urlencode($keyword);
        return $this;
    }

    public function person($person = [])
    {
        $this->person = $person;
        return $this;
    }

    public function technique($technique = [])
    {
        $this->technique = $technique;
        return $this;
    }

    public function medium($medium = [])
    {
        $this->medium = $medium;
        return $this;
    }

    public function place($place = [])
    {
        $this->place = $place;
        return $this;
    }

    public function worktype($worktype = [])
    {
        $this->worktype = $worktype;
        return $this;
    }

    public function color($color = [])
    {
        $this->color = $color;
        return $this;
    }

    public function period($period = [])
    {
        $this->period = $period;
        return $this;
    }

    public function relatedto($relatedto = [])
    {
        $this->relatedto = $relatedto;
        return $this;
    }

    public function onview($onview = [])
    {
        if (!empty($onview)) {
            $this->gallery = 'any';
        }
        return $this;
    }

    public function cleanFilters()
    {
        parent::cleanFilters();

        $this->classification = [];
        $this->gallery    = [];
        $this->century    = [];
        $this->culture    = [];
        $this->custom     = [];
        $this->person     = [];
        $this->exhibition = null;
        $this->group      = null;
        $this->relatedto  = null;
        $this->exact_title  = null;
        $this->objectnumber = null;
        $this->keyword = null;
    }
}
