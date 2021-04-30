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
        $cidadePrestacao->setTipoLogradouro('Rua');
        $cidadePrestacao->setLogradouro("Teste A");
        $cidadePrestacao->setNumero("1705");
        $cidadePrestacao->setComplemento("Casa");
        $cidadePrestacao->setTipoBairro("Chácara");
        $cidadePrestacao->setBairro("Bairro A");
        $cidadePrestacao->setEstado("PR");
        $cidadePrestacao->setCep("87010-370");

        $this->assertSame($cidadePrestacao->getCodigo(), '1234');
        $this->assertSame($cidadePrestacao->getDescricao(), 'Cidade de Teste');
        $this->assertSame($cidadePrestacao->getTipoLogradouro(), 'Rua');
        $this->assertSame($cidadePrestacao->getLogradouro(), 'Teste A');
        $this->assertSame($cidadePrestacao->getNumero(), '1705');
        $this->assertSame($cidadePrestacao->getComplemento(), 'Casa');
        $this->assertSame($cidadePrestacao->getTipoBairro(), 'Chácara');
        $this->assertSame($cidadePrestacao->getBairro(), 'Bairro A');
        $this->assertSame($cidadePrestacao->getEstado(), 'PR');
        $this->assertSame($cidadePrestacao->getCep(), '87010-890');
        
    }

    public function testToArray()
    {
        $cidadePrestacao = new CidadePrestacao();
        $cidadePrestacao->setCodigo('1234');
        $cidadePrestacao->setDescricao('Cidade de Teste');
        $cidadePrestacao->setTipoLogradouro('Rua');
        $cidadePrestacao->setLogradouro("Teste A");
        $cidadePrestacao->setNumero("1705");
        $cidadePrestacao->setComplemento("Casa");
        $cidadePrestacao->setTipoBairro("Chácara");
        $cidadePrestacao->setBairro("Bairro A");
        $cidadePrestacao->setEstado("PR");
        $cidadePrestacao->setCep("87010-370");

        $cidadePrestacaoArray = $cidadePrestacao->toArray();

        $this->assertArrayHasKey('codigo', $cidadePrestacaoArray);
        $this->assertArrayHasKey('descricao', $cidadePrestacaoArray);
        $this->assertArrayHasKey('tipoLogradouro', $cidadePrestacaoArray);
        $this->assertArrayHasKey('logradouro', $cidadePrestacaoArray);
        $this->assertArrayHasKey('numero', $cidadePrestacaoArray);
        $this->assertArrayHasKey('complemento', $cidadePrestacaoArray);
        $this->assertArrayHasKey('tipoBairro', $cidadePrestacaoArray);
        $this->assertArrayHasKey('bairro', $cidadePrestacaoArray);
        $this->assertArrayHasKey('estado', $cidadePrestacaoArray);
        $this->assertArrayHasKey('cep', $cidadePrestacaoArray);
    }
}
