<?php

namespace TecnoSpeed\Plugnotas\Tests\Common\ConfigNfse;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Error\ValidationError;

use TecnoSpeed\Plugnotas\Common\ConfigNfse\Rps;

class RpsTest extends TestCase
{
    /**
     * @covers TecnoSpeed\Plugnotas\Common\ConfigNfse\Rps::setSerie
     */
    public function testInvalidSerie()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Serie tem que ser um valor string');
        $rps = new Rps();
        $rps->setSerie(1);
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\ConfigNfse\Rps::setNumero
     */
    public function testInvalidNumero()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Numero tem que ser um valor inteiro');
        $rps = new Rps();
        $rps->setNumero('numero');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\ConfigNfse\Rps::setLote
     */
    public function testInvalidLote()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Lote tem que ser um valor inteiro');
        $rps = new Rps();
        $rps->setLote('lote');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\ConfigNfse\Rps::fromArray
     */
    public function testWithValidArray()
    {
        $rps = Rps::fromArray([
            'lote' => 0,
            'serie' => '1',
            'numero' => 0
        ]);

        $this->assertSame($rps->getLote(), 0);
        $this->assertEquals($rps->getSerie(), '1');
        $this->assertEquals($rps->getNumero(), 0);
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\ConfigNfse\Rps::setLote
     * @covers TecnoSpeed\Plugnotas\Common\ConfigNfse\Rps::setSerie
     * @covers TecnoSpeed\Plugnotas\Common\ConfigNfse\Rps::setNumero
     */
    public function testWithValidData()
    {
        $rps = new Rps();
        $rps->setLote(0);
        $rps->setSerie('1');
        $rps->setNumero(0);

        $this->assertSame($rps->getLote(), 0);
        $this->assertSame($rps->getSerie(), '1');
        $this->assertSame($rps->getNumero(), 0);
    }
}
