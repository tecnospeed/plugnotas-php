<?php

namespace TecnoSpeed\Plugnotas\Communication;

class Response
{
    public $body;
    public $statusCode;

    public static function parse($response)
    {
        $responseObject = new Response;
        $responseObject->body = \json_decode($response->getBody()->getContents());
        $responseObject->statusCode = $response->getStatusCode();

        return $responseObject;
    }
}
