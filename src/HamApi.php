<?php namespace Harvardartmuseums\HamAPI;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Http\Client\RequestException;


class HamApi
{

    const CACHE_TIME = 60 * 15; #(seconds)

    private $_api_key = null;
    private $_api_url = null;

    public function __construct()
    {
        $this->_api_key = config('hamapi.api_key');
        $this->_api_url = config('hamapi.api_url');
        if (empty($this->_api_key)) {
            throw new \Exception('No API Key has been set');
        }
    }


  // Receives an object containing the Endpoint
    public function getDatas($object = null, $count = false)
    {
        $url = $this->buildUrl($object);
        $result = Cache::remember(sha1(implode('-', [$url, $count])), self::CACHE_TIME, function () use ($url, $count) {
            return $this->callApi('GET', $url, $count);
        });
        return $result;
    }

    private function buildUrl($object)
    {
        if ($object->endpoint == "objectentries") {
            $url = $this->_api_url . '/object';
        } else {
            $url = $this->_api_url . '/' . $object->endpoint;
        }

        $ignoredParams = [
        'id','endpoint', 'search_fields', 'operator', 'exact_match_fields', 'custom'
        ];

        if ($object->id) {
            $url .= '/' . $object->id;
        }

        if ($object->endpoint == "objectentries") {
            $url .= '/entries';
        }

        if (strpos($url, '?') !== false) {
            $url .= '&';
        } else {
            $url .= '?';
        }

        $url .= 'apikey='.$this->_api_key;

        $objectVariables = get_object_vars($object);

        foreach ($objectVariables as $attribute => $value) {
            if (!in_array($attribute, $ignoredParams) && (isset($value) && (!empty($value) || $value === '0' ))) {
                if (!is_array($value)) {
                    if ($attribute == 'q') {
                        $url .= '&' .$attribute . '=';
                        foreach ($object->search_fields as $key_fields => $field) {
                            $texts = explode(" ", $value);
                            foreach ($texts as $key => $text) {
                                if (in_array($field, $object->exact_match_fields)) {
                                    $url .= $field . ':' . $text;
                                } else {
                                    $url .= $field . ':*' . $text . '*';
                                }
                                if ($key + 1 < sizeof($texts)) {
                                    $url .= '%20' . $object->operator .'%20';
                                }
                            }
                            if ($key_fields + 1 < sizeof($object->search_fields)) {
                                $url .= '%20' . $object->operator .'%20';
                            }
                        }
                    } else {
                        $url .= '&' .$attribute . '=' . rtrim($value, '+');
                        ;
                    }
                } else {
                    $url .= '&' .$attribute . '=';

                    foreach ($value as $key => $val) {
                        if ($key == 'objectnumber' && $attribute == 'q') {
                            $url .= $key . ':"' . urlencode($val) . '",';
                        } else if ($key && $key == 'temporalorder') {
                            $url .= $key . ':' . urlencode($val) . '';
                        } else if ($key && $attribute == 'usedby') {
                            $url .= $key . ':' . urlencode($val) . '';
                        } else {
                            $url .= str_replace(' ', '%20', urlencode($val));
                            if ($key + 1 < sizeof($value)) {
                                $url .= '|';
                            }
                        }
                    }
                }
            }

            # Custom filters: Check how to avoid duplication
            if ($attribute == 'custom' && isset($value) && (!empty($value) || $value === '0' )) {
                foreach ($value as $customName => $customValue) {
                    if (is_array($customValue)) {
                        $url .= '&' . $customName . '=' . str_replace(' ', '%20', implode('|', $customValue));
                    } else {
                        $url .= '&' . $customName . '=' . str_replace(' ', '%20', urlencode($customValue));
                    }
                }
            }
        }
        Log::info($url);
        return $url;
    }

    private function callApi($method, $url, $includeInfos = false, $datas = null, $returnFormat = 'object')
    {
        try {
            if ($returnFormat == 'object') {
                $result = json_decode(Http::retry(3, 100)->get($url));

                if (!empty($result->status)) {
                    if ($result->status == '400') {
                        return false;
                    } elseif ($result->status == '401') {
                        return false;
                    } elseif ($result->status == '403') {
                        return false;
                    } elseif ($result->status == '500') {
                        return false;
                    }
                }

                if (!empty($result->info)) {
                    if ($includeInfos) {
                        return $result;
                    } else {
                        if (!empty($result->records)) {
                            return $result->records;
                        } else {
                            return null;
                        }
                    }
                } else {
                    if (empty($result->error)) {
                        return $result;
                    } else {
                        return null;
                    }
                }
            }
        } catch (RequestException $e) {
            Log::error('HAM API Error: ' . $e->getMessage(), [
                'url' => $url,
                'status' => $e->response->status(),
                'body' => $e->response->body()
            ]);
            return false;
        } catch (Exception $e) {
            Log::error('HAM API Unexpected Error: ' . $e->getMessage());
            return false;
        }
    }
}