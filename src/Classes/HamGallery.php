<?php

namespace Harvardartmuseums\HamAPI\Classes;

class HamGallery extends HamClass
{
    public $endpoint = 'gallery';

  //floor=[Floor Number]
    public $floor = null;

    public $search_fields = [
    'floor'
    ];

    public function floor($floor = '')
    {
        $this->floor = rawurlencode($floor);
        return $this;
    }
}
