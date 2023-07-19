<?php

return [
  'api_key' => env('HAM_API_KEY'),
  'api_url' => env('HAM_API_URL'),
  'imagecache' => [
        'ids'=> env('IDS_CACHE_HOST'),
        'nrs' => env('NRS_PROXY_HOST'),
        'enabled'=> env('IMAGE_CACHE_ENABLED')
    ]
];
