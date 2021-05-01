<?php

namespace TecnoSpeed\Plugnotas\Tests\Common;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Error\ValidationError;

use TecnoSpeed\Plugnotas\Common\Nfse;
use TecnoSpeed\Plugnotas\Common\ConfigNfse\Config;

class NfseTest extends TestCase
{
    /**
     * @covers TecnoSpeed\Plugnotas\Common\Nfse::setAtivo
     */
    public function testInvalidAtivo()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Ativo é requerido para o cadastro de NFS-e.');
        $nfse = new Nfse();
        $nfse->setAtivo('teste');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\Nfse::setAtivo
     */
    public function testEmptyTipoAtivo()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Ativo é requerido para o cadastro de NFS-e.');
        $nfse = new Nfse();
        $nfse->setAtivo(null);
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\Nfse::setTipoContrato
     */
    public function testInvalidTipoContrato()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Valor inválido para o TipoContrato. Valores aceitos: null, 0, 1');
        $nfse = new Nfse();
        $nfse->setTipoContrato('teste');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\Nfse::fromArray
     */
    public function testWithValidArray()
    {
        $nfse = Nfse::fromArray([
            'ativo' => true,
            'tipoContrato' => 0,
            'config' => []
        ]);

        $this->assertSame($nfse->getAtivo(), true);
        $this->assertSame($nfse->getTipoContrato(), 0);
        $this->assertEquals($nfse->getConfig(), new Config([]));
    }
}
