<?php

namespace TecnoSpeed\Plugnotas\Tests;

use PHPUnit\Framework\TestCase;

use TecnoSpeed\Plugnotas\Logotipo;
use TecnoSpeed\Plugnotas\Configuration;

class LogotipoTest extends TestCase
{
    public function testCreateLogotipo()
    {
        $configuration = new Configuration();

        $logotipo = new Logotipo();
        $logotipo->setFile(__DIR__.'/../examples/logotipo.png', 'logotipo.png');

        $cnpj = '08187168000160';
        $response = $logotipo->create($cnpj, $configuration);

        $this->assertEquals(200, $response->statusCode);
        $this->assertObjectHasAttribute('message', $response->body);
        $this->assertSame('Upload realizado com sucesso', $response->body->message);
    }
}
