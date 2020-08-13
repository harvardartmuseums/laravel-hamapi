<?php namespace Harvardartmuseums\HamAPI;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HamApi
{

    const CACHE_TIME = 15; #(minutes)

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
                            $url .= $key . ':"' . $val . '",';
                        } else if ($key && $key == 'temporalorder') {
                            $url .= $key . ':' . $val . '';
                        } else if ($key && $attribute == 'usedby') {
                            $url .= $key . ':' .$val . '';
                        } else {
                            $url .= str_replace(' ', '%20', $val);
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
                        $url .= '&' . $customName . '=' . str_replace(' ', '%20', $customValue);
                    }
                }
            }
        }
        Log::info($url);
        return $url;
    }

    private function callApi($method, $url, $includeInfos = false, $datas = null, $returnFormat = 'object')
    {

        if ($returnFormat == 'object') {
            $result = json_decode($this->curlOp($method, $url, $datas));

            if (!empty($result->status)) {
                if ($result->status == '400') {
                    return false;
                } elseif ($result->status == '401') {
                    ///401 Unauthorized
                    //Similar to 403 Forbidden, but specifically for use when authentication is possible but has failed or not yet been provided.
                    //The response must include a WWW-Authenticate header field containing a challenge applicable to the requested resource.
                    return false;
                } elseif ($result->status == '403') {
                    //404 Forbidden
                    //The request was a legal request, but the server is refusing to respond to it. Unlike a 401 Unauthorized response, authenticating will make no difference.
                    return false;
                } elseif ($result->status == '500') {
                    //500 Internal Server Error
                    //A generic error message, given when no more specific message is suitable.
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
    }

    private function curlOp($method, $url, $data = false)
    {
        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data) {
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                }
        }

        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "username:password");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_VERBOSE, 1);

        return curl_exec($curl);
    }
}