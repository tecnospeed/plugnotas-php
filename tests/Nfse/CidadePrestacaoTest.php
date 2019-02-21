<?php

namespace TecnoSpeed\Plugnotas\Tests\Nfse;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Nfse\CidadePrestacao;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class CidadePrestacaoTest extends TestCase
{
    public function testWithValidData()
    {
        $cidadePrestacao = new CidadePrestacao();
        $cidadePrestacao->setCodigo('1234');
        $cidadePrestacao->setDescricao('Cidade de Teste');

        $this->assertSame($cidadePrestacao->getCodigo(), '1234');
        $this->assertSame($cidadePrestacao->getDescricao(), 'Cidade de Teste');
    }

    public function testToArray()
    {
        $cidadePrestacao = new CidadePrestacao();
        $cidadePrestacao->setCodigo('1234');
        $cidadePrestacao->setDescricao('Cidade de Teste');

        $cidadePrestacaoArray = $cidadePrestacao->toArray();

        $this->assertArrayHasKey('codigo', $cidadePrestacaoArray);
        $this->assertArrayHasKey('descricao', $cidadePrestacaoArray);
    }
}
