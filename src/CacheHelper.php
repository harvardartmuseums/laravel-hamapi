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

        
        $imageCacheHost = config('hamapi.imagecache.ids');
        $nrsProxyHost = config('hamapi.imagecache.nrs');
        $cacheEnabled = config('hamapi.imagecache.enabled');

        $cacheServerStatus = Cache::remember('cache_server_status', 900, function () {
            return is_array(@get_headers('https://' . config('hamapi.imagecache.ids')));
        });

       
        if ($cacheEnabled === true){
            if($cacheServerStatus) {
                    $data = json_decode(str_replace ('ids.lib.harvard.edu', $imageCacheHost, json_encode($data), $ids_count));
                    $data = json_decode(str_replace ('nrs.harvard.edu', $nrsProxyHost, json_encode($data), $nrs_count));    
            }
        }
        return $data;
    }
}
