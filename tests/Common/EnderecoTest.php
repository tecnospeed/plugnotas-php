<?php

namespace TecnoSpeed\Plugnotas\Tests\Common;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Common\Endereco;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class EnderecoTest extends TestCase
{
    public function testInvalidTipoLogradouro()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Tipo de logradouro não suportado.');
        $endereco = new Endereco();
        $endereco->setTipoLogradouro('teste');
    }

    public function testEmptyLogradouro()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Logradouro é um campo requerido.');
        $endereco = new Endereco();
        $endereco->setLogradouro(null);
    }

    public function testEmptyNumero()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Número é um campo requerido.');
        $endereco = new Endereco();
        $endereco->setNumero(null);
    }

    public function testInvalidTipoBairro()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Tipo de bairro não suportado.');
        $endereco = new Endereco();
        $endereco->setTipoBairro('teste');
    }

    public function testInvalidCodigoCidade()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage(
            'Código da cidade inválido, por favor verifique se foram informados 7 números.'
        );
        $endereco = new Endereco();
        $endereco->setCodigoCidade('1234');
    }

    public function testInvalidEstado()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Estado inválido.');
        $endereco = new Endereco();
        $endereco->setEstado('ZZ');
    }

    public function testInvalidCep()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('CEP inválido, por favor verifique se foram informados 8 números.');
        $endereco = new Endereco();
        $endereco->setCep('123456');
    }

    public function testFullAddress()
    {
        $endereco = new Endereco();
        $endereco->setTipoLogradouro('Avenida');
        $endereco->setLogradouro('Duque de Caxias');
        $endereco->setNumero('882');
        $endereco->setComplemento('17 andar');
        $endereco->setTipoBairro('Zona');
        $endereco->setBairro('Zona 7');
        $endereco->setCodigoCidade('4115200');
        $endereco->setDescricaoCidade('Maringá');
        $endereco->setEstado('PR');
        $endereco->setCep('87.020-025');

        $this->assertSame($endereco->getTipoLogradouro(), 'Avenida');
        $this->assertSame($endereco->getLogradouro(), 'Duque de Caxias');
        $this->assertSame($endereco->getNumero(), '882');
        $this->assertSame($endereco->getComplemento(), '17 andar');
        $this->assertSame($endereco->getTipoBairro(), 'Zona');
        $this->assertSame($endereco->getBairro(), 'Zona 7');
        $this->assertSame($endereco->getCodigoCidade(), '4115200');
        $this->assertSame($endereco->getDescricaoCidade(), 'Maringá');
        $this->assertSame($endereco->getEstado(), 'PR');
        $this->assertSame($endereco->getCep(), '87020025');
    }
}
