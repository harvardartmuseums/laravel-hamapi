<?php

namespace Harvardartmuseums\HamAPI;

# Include Laravel helpers
use Illuminate\Support\helpers;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class BrowseHelper
{

protected $_limit_objects = 12;

public function results(Request $request)
    {
        $input_default = [
        'offset' => 0,
        'group' => '',
        'classification' => [],
        'technique' => [],
        'medium' => [],
        'place' => [],
        'gallery' => [],
        'person' => [],
        'worktype' => [],
        'color' => [],
        'culture' => [],
        'century' => [],
        'period' => [],
        'onview' => [],
        'q' => '',

        'custom' => [],
        'sort' => 'rank',
        ];

        $input = array_merge($input_default, $request->all());

        if (array_key_exists('load_amount', $input)) {
            $this->_limit_objects = $input['load_amount'];
        }

        Session::put('input', $input);

        $service = new \Harvardartmusems\HamAPI\BrowseService;
        $result  = $service->search($input, $input['offset'], $this->_limit_objects, $input['sort']);

        return $result;
    }
}