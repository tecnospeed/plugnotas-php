<?php

namespace TecnoSpeed\Plugnotas\Tests\Common\ConfigNfse;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Error\ValidationError;

use TecnoSpeed\Plugnotas\Common\ConfigNfse\Prefeitura;

class PrefeituraTest extends TestCase
{
    /**
     * @covers TecnoSpeed\Plugnotas\Common\ConfigNfse\Prefeitura::setDataInicio
     */
    public function testInvalidDataInicio()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Formato da data é inválido. Formato válido YYYY-MM-DD.');
        $rps = new Prefeitura();
        $rps->setDataInicio('30/04/2021');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\ConfigNfse\Prefeitura::fromArray
     */
    public function testWithValidArray()
    {
        $rps = Prefeitura::fromArray([
            'login' => 'login',
            'senha' => 'senha',
            'receitaBruta' => 100.0,
            'lei' => '113',
            'dataInicio' => '2021-04-30',
        ]);

        $this->assertSame($rps->getLogin(), 'login');
        $this->assertEquals($rps->getSenha(), 'senha');
        $this->assertEquals($rps->getReceitaBruta(), 100.0);
        $this->assertEquals($rps->getLei(), '113');
        $this->assertEquals($rps->getDataInicio(), '2021-04-30');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\ConfigNfse\Prefeitura::setLogin
     * @covers TecnoSpeed\Plugnotas\Common\ConfigNfse\Prefeitura::setSenha
     * @covers TecnoSpeed\Plugnotas\Common\ConfigNfse\Prefeitura::setReceitaBruta
     * @covers TecnoSpeed\Plugnotas\Common\ConfigNfse\Prefeitura::setLei
     * @covers TecnoSpeed\Plugnotas\Common\ConfigNfse\Prefeitura::setDataInicio
     */
    public function testWithValidData()
    {
        $rps = new Prefeitura();
        $rps->setLogin('login');
        $rps->setSenha('senha');
        $rps->setReceitaBruta(100.0);
        $rps->setLei('113');
        $rps->setDataInicio('2021-04-30');

        $this->assertSame($rps->getLogin(), 'login');
        $this->assertEquals($rps->getSenha(), 'senha');
        $this->assertEquals($rps->getReceitaBruta(), 100.0);
        $this->assertEquals($rps->getLei(), '113');
        $this->assertEquals($rps->getDataInicio(), '2021-04-30');
    }
}
