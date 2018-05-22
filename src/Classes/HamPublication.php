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
}
