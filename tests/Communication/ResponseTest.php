<?php

namespace TecnoSpeed\Plugnotas\Tests\Communication;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Communication\Response;

class ResponseTest extends TestCase
{
    /**
     * @covers TecnoSpeed\Plugnotas\Communication\Response::parse
     */
    public function testWithValidData()
    {
        $status = 200;
        $headers = ['X-Foo' => 'Bar'];
        $body = '{"teste": "teste"}';
        $protocol = '1.1';
        $guzzleResponse = new GuzzleResponse($status, $headers, $body, $protocol);
        $response = Response::parse($guzzleResponse);

        $this->assertSame(200, $response->statusCode);
        $this->assertSame('teste', $response->body->teste);
    }
}

