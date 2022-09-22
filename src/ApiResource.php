<?php

namespace Media24si\ApiResource;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Psr\Http\Message\ResponseInterface;

class ApiResource
{
    private Client $client;

    private array $endpoints;

    /**
     * ApiResource constructor.
     */
    public function __construct()
    {
        $this->client = new Client(config('apiresource.defaults'));
        $this->endpoints = config('apiresource.endpoints');
    }

    public function get($uri, array $options = [])
    {
        $response = $this->request('GET', $uri, $options);

        if ($response->hasHeader('Content-Type')) {
            $contentType = $response->getHeader('Content-Type')[0];

            if (Str::contains($contentType, '/json')) {
                return json_decode($response->getBody());
            }
        }

        return $response;
    }

    public function request(string $method, $uri = '', array $options = []): ResponseInterface
    {
        if (config('apiresource.merge')) {
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

        return $this->client->request($method, $uri, $options);
    }
}
