<?php

namespace Harvardartmuseums\HamAPI;

# Include Laravel helpers
use Illuminate\Support\helpers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class VarnishHelper
{

    public static function varnishify($data)
    {
        $varnishServerStatus = 0;

        Cache::remember('varnish_server_status', 900, function () {
            return is_array(@get_headers(config('hamapi.imagecache.url')));
        });

        $varnishServerStatus = Cache::get('varnish_server_status');
        $varnishURL = config('hamapi.imagecache.url');
        $varnishEnabled = config('hamapi.imagecache.enabled');

        if ($varnishEnabled === true){
          if($varnishServerStatus) {
            if (!empty($data->primaryimageurl) && !empty($data->images)) {
                $data->primaryimageurl = $varnishURL . "/ids/view/" . $data->images[0]->idsid;
                foreach ($data->images as &$image) {
                    $image->baseimageurl = $varnishURL . "/ids/view/" . $image->idsid;
                }
                if (!empty($data->poster)) {
                    $data->poster->imageurl = $varnishURL . "/ids/view/" . $data->images[0]->idsid;
                }
            } elseif (!empty($data->records)) {
                foreach ($data->records as &$record) {
                    if (!empty($record->primaryimageurl) && !empty($record->images)) {
                        $record->primaryimageurl = $varnishURL . "/ids/view/" . $record->images[0]->idsid;
                        foreach ($record->images as &$image) {
                            $image->baseimageurl = $varnishURL . "/ids/view/" . $image->idsid;
                        }
                        if (!empty($record->poster)) {
                            $record->poster->imageurl = $varnishURL . "/ids/view/" . $record->images[0]->idsid;
                        }
                    }
                }
            } elseif (is_array($data) || $data instanceof Traversable) {
                foreach ($data as &$record) {
                    if (!empty($record->primaryimageurl) && !empty($record->primaryimageurl)) {
                        $record->primaryimageurl = $varnishURL . "/ids/view/" . $record->images[0]->idsid;
                        foreach ($record->images as &$image) {
                            $image->baseimageurl = $varnishURL . "/ids/view/" . $image->idsid;
                        }
                        if (!empty($record->poster)) {
                            $record->poster->imageurl = $varnishURL . "/ids/view/" . $record->images[0]->idsid;
                        }
                    }
                }
            }
        }
      }
        return $data;
    }
}
