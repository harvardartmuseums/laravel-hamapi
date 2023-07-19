<?php

namespace Harvardartmuseums\HamAPI;

# Include Laravel helpers
use Illuminate\Support\helpers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheHelper
{

    public static function cacheify($data)
    {
        $cacheServerStatus = 0;

        Cache::remember('cache_server_status', 900, function () {
            return is_array(@get_headers(config('hamapi.imagecache.ids')));
        });

        $cacheServerStatus = Cache::get('cache_server_status');
        $imageCacheHost = config('hamapi.imagecache.ids');
        $nrsProxyHost = config('hamapi.imagecache.nrs');
        $cacheEnabled = config('hamapi.imagecache.enabled');

        if ($cacheEnabled === true){
          if($cacheServerStatus) {
                $ids = str_replace ( 'https://ids.lib.harvard.edu', $imageCacheHost, $data);
                $data = str_replace ( 'https://nrs.harvard.edu', $nrsProxyHost, $ids);
            }
        }
        return $data;
    }
}
