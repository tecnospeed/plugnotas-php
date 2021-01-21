<?php

namespace TecnoSpeed\Plugnotas\Tests;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Configuration;
use TecnoSpeed\Plugnotas\Certificado;

class CertificadoTest extends TestCase
{
    public function testGetAllCertificates()
    {
        $configuration = new Configuration();

        $certificado = new Certificado();
        $certificado->setConfiguration($configuration);

        $response = $certificado->get();

        $this->assertObjectHasAttribute('body', $response);
        $this->assertEquals(200, $response->statusCode);
        $this->assertCount(1, $response->body);
    }

    public function testCreateCertificate()
    {
        $configuration = new Configuration();

        $certificado = new Certificado();
        $certificado->setConfiguration($configuration);
        $certificado->setFile(__DIR__.'/../examples/certificado.pfx', 'arquivo.pfx');
        $certificado->setPassword('1234');

        $response = $certificado->create();

        $this->assertEquals(201, $response->statusCode);
        $this->assertObjectHasAttribute('body', $response);
        $this->assertObjectHasAttribute('message', $response->body);
        $this->assertObjectHasAttribute('id', $response->body->data);
    }

    public function testUpdateCertificate()
    {
        $id = md5(uniqid(rand(), true));

        $configuration = new Configuration();

        $certificado = new Certificado();
        $certificado->setConfiguration($configuration);
        $certificado->setFile(__DIR__.'/../examples/certificado-update.pfx', 'arquivo-update.pfx');
        $certificado->setPassword('1234');

        $response = $certificado->update($id);

        $this->assertEquals(200, $response->statusCode);
        $this->assertObjectHasAttribute('body', $response);
        $this->assertObjectHasAttribute('message', $response->body);
    }
}
