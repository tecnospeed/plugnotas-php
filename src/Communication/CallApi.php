<?php

namespace TecnoSpeed\Plugnotas\Communication;

use TecnoSpeed\Plugnotas\Configuration;
use TecnoSpeed\Plugnotas\Communication\Response as ResponseObject;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\ClientException;

class CallApi
{
    private $client;
    private $key;
    private $url;

    public function __construct(Configuration $configuration)
    {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $configuration->getUrl(),
            'timeout' => 10.0
        ]);
        $this->headers = [
            'User-Agent' => 'plugnotas/1.0',
            'Accept' => 'application/json',
            'x-api-key' => $configuration->getApiKey()
        ];
        $this->key = $configuration->getApiKey();
        $this->url = $configuration->getUrl();
    }

    public function send($method, $destination, $data)
    {
        try {
            if ($method === 'GET') {
                return $this->client->request($method, $destination);
            }
    
            $response = $this->client->request(
                $method,
                $destination,
                [
                    'headers' => $this->headers,
                    'json' => $data
                ]
            );

            return ResponseObject::parse($response);
        } catch (ClientException $ce) {
            $response = $ce->getResponse();
            return ResponseObject::parse($response);
        }
    }
}
