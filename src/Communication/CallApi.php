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

    public function setClient($client)
    {
        $this->client = $client;
    }

    public function send($method, $destination, $data)
    {
        try {
            if ($method === 'GET') {
                $response = $this->client->request(
                    $method,
                    $destination,
                    [
                        'headers' => $this->headers
                    ]
                );

                return ResponseObject::parse($response);
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

    public function sendWithFiles($method, $destination, $data)
    {
        try {
            $response = $this->client->request(
                $method,
                $destination,
                [
                    'headers' => $this->headers,
                    'multipart' => $data
                ]
            );

            return ResponseObject::parse($response);
        } catch (ClientException $ce) {
            $response = $ce->getResponse();
            return ResponseObject::parse($response);
        }
    }

    public function download($method, $destination, $data, $fileName)
    {
        try {
            if ($method === 'GET') {
                $response = $this->client->request(
                    $method,
                    $destination,
                    [
                        'headers' => $this->headers,
                        'sink' => $fileName
                    ]
                );

                return ResponseObject::parse($response);
            }

            $response = $this->client->request(
                $method,
                $destination,
                [
                    'headers' => $this->headers,
                    'json' => $data,
                    'sink' => $fileName
                ]
            );

            return ResponseObject::parse($response);
        } catch (ClientException $ce) {
            $response = $ce->getResponse();
            return ResponseObject::parse($response);
        }
    }
}
