<?php

namespace Harvardartmuseums\HamAPI\Classes;

class HamCustomCollectionValue extends HamClass
{
    public $endpoint = '';

    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
    }
}
