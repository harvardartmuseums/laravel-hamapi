<?php

namespace Harvardartmuseums\HamAPI\Classes;

class HamExhibition extends HamClass
{
    public $endpoint = 'exhibition';
    public $status = '';
  //venue=[“HAM”]
    public $venue = 'HAM';

    public $search_fields = [
    'title','description','shortdescription'
    ];

    public $exact_match_fields = [
    'title'
    ];

  //before=[YYYY-MM-DD]
    public $before = [];

  //after=[YYYY-MM-DD]
    public $after =  [];

    public $hasimage = 0;

    public function status($status = '')
    {
        $this->status = $status;
        return $this;
    }

    public function before($date = null)
    {
        if (is_array($date)) {
            $this->before = key($date) . ':' . $date[key($date)];
        } else {
            $this->before = $date;
        }
        return $this;
    }

    public function after($date = null)
    {
        if (is_array($date)) {
            $this->after = key($date) . ':' . $date[key($date)];
        } else {
            $this->after = $date;
        }
        return $this;
    }

    public function getNext($exhibition_id)
    {
        $this->after = ['temporalorder' => $exhibition_id];
        $this->size = 1;
        $this->sort = 'chronological';
        $this->sortorder = 'asc';
        return $this;
    }

    public function getPrevious($exhibition_id)
    {
        $this->before = ['temporalorder' => $exhibition_id];
        $this->size = 1;
        $this->sort = 'chronological';
        $this->sortorder = 'desc';
        return $this;
    }

    public function cleanFilters()
    {
        parent::cleanFilters();

        $this->before = '';
        $this->after  = '';
    }
}
