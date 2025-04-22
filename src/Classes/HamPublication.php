<?php

namespace Harvardartmuseums\HamAPI\Classes;

class HamPublication extends HamClass
{
    public $endpoint = 'publication';

  //isinshop=[1 OR 0]
    public $isinshop = null;

    public $search_fields = [
    'title','volumetitle'
    ];

    public function isInShop($isinshop = '')
    {
        $this->isinshop = rawurlencode($isinshop);
        return $this;
    }

    public function getNext($publication_id)
    {
        $this->after = ['temporalorder' => $publication_id];
        $this->size = 1;
        $this->sort = 'temporalorder';
        $this->sortorder = 'asc';

        return $this;
    }

    public function getPrevious($publication_id)
    {
        $this->before = ['temporalorder' => $publication_id];
        $this->size = 1;
        $this->sort = 'temporalorder';
        $this->sortorder = 'desc';

        return $this;
    }
}
