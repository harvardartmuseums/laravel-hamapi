<?php

namespace Harvardartmuseums\HamAPI\Classes;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\Log;

class HamCustomCollection extends HamClass
{
    public $endpoint = '';
    public $sorted   = false;

    public function forId($id)
    {
        $this->endpoint = $this->getEndpoint($id);

        return $this;
    }

    public function sorted($value = false)
    {
        $this->sorted = $value;
        return $this;
    }

    public function find($id = '')
    {
        $result = parent::find($id);

        if ($result) {
            foreach ($result as $index => $filter) {
                if (empty($filter->values) && !empty($filter->valuesurl)) {
                    $url = $filter->valuesurl;

                    # Clean the first / if present
                    if (substr($url, 0, strlen('/')) == '/') {
                        $url = substr($url, strlen('/'));
                    }

                    $CustomCollectionValue = new HamCustomCollectionValue();
                    $values = $CustomCollectionValue->setEndpoint($url)->find();

                    # If it has multiple levels, sort those using the helper
                    if ($this->sorted && $filter->multiple_levels === true) {
                        $result[$index]->values = \App\Helpers\Helpers::sortFiltersByLevel($values);
                    } else {
                        $result[$index]->values = $values;
                    }
                }
            }
        }
        return $result;
    }

    public function getEndpoint($id)
    {
        return 'group/' . $id . '/filters';
    }
}
