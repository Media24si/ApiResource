<?php

namespace Media24si\ApiResource;

use GuzzleHttp\Client;

class ApiResource extends Client
{

    /**
     * @var array
     */
    private $endpoints;

    /**
     * ApiResource constructor.
     */
    public function __construct()
    {
        parent::__construct(config('apiresource.defaults'));

        $this->endpoints = config('apiresource.endpoints');
    }

    public function request($method, $uri = null, array $options = [])
    {
        if(config('apiresource.merge')) {
            $options = array_replace_recursive(config('apiresource.merge', []), $options);
        }

        // overwrite from endpoints
        if (isset($this->endpoints[$uri])) {
            $key = $uri;
            $uri = $this->endpoints[$key]['uri'];

            if (isset($this->endpoints[$key]['options']) && is_array($this->endpoints[$key]['options'])) {
                $options = array_replace_recursive($this->endpoints[$key]['options'], $options);
            }
        }

        $response = parent::request($method, $uri, $options);

        if ($response->hasHeader('Content-Type')) {
            $contentType = $response->getHeader('Content-Type')[0];

            if ( str_contains($contentType, '/json') ) {
                return json_decode( $response->getBody() );
            }
        }

        return $response;
    }
}
