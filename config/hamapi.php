<?php

return [
  'api_key' => env('HAM_API_KEY'),
  'api_url' => env('HAM_API_URL'),
  'imagecache' => [
        'url'=> env('VARNISH_URL'),
        'enabled'=> env('VARNISH_ENABLED')
    ]
];
