<?php

namespace TecnoSpeed\Plugnotas\Tests\Builders;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Builders\NfseBuilder;
use TecnoSpeed\Plugnotas\Common\Endereco;
use TecnoSpeed\Plugnotas\Common\Telefone;
use TecnoSpeed\Plugnotas\Error\InvalidTypeError;
use TecnoSpeed\Plugnotas\Error\ValidationError;
use TecnoSpeed\Plugnotas\Nfse\CidadePrestacao;
use TecnoSpeed\Plugnotas\Nfse\Impressao;
use TecnoSpeed\Plugnotas\Nfse\Prestador;
use TecnoSpeed\Plugnotas\Nfse\Rps;
use TecnoSpeed\Plugnotas\Nfse\Servico;
use TecnoSpeed\Plugnotas\Nfse\Tomador;

class NfseBuilderTest extends TestCase
{
    public function testWithWrongObjectType()
    {
        $this->expectException(InvalidTypeError::class);
        $this->expectExceptionMessage(
            'Deve ser informado um array ou um objeto do tipo: TecnoSpeed\Plugnotas\Nfse\CidadePrestacao'
        );
        $nfse = (new NfseBuilder)
            ->withCidadePrestacao('teste')
            ->build();
    }

    public function testWithOneObject()
    {
        $nfse = (new NfseBuilder)
            ->withCidadePrestacao(CidadePrestacao::fromArray([
                'codigo' => '123'
            ]))
            ->build();
        $this->assertInstanceOf(CidadePrestacao::class, $nfse->getCidadePrestacao());
    }

    public function testWithValidData()
    {
        $nfse = (new NfseBuilder)
            ->withCidadePrestacao([
                'codigo' => '123'
            ])
            ->withTomador([
                'cpfCnpj' => '00.000.000/0001-91',
                'razaoSocial' => 'Tomador Teste'
            ])
            ->withPrestador([
                'cpfCnpj' => '00.000.000/0001-91',
                'razaoSocial' => 'Prestador Teste'
            ])
            ->withServico([
                'iss' => [
                    'aliquota' => 1.01
                ]
            ])
            ->withRps([
                'dataEmissao' => '2019-02-27'
            ])
            ->withImpressao([
                'camposCustomizados' => [
                    'teste' => 'teste impressao'
                ]
            ])
            ->build([
                'enviarEmail' => true,
                'idIntegracao' => 'asdf1234',
                'substituicao' => false
            ]);
        $this->assertInstanceOf(CidadePrestacao::class, $nfse->getCidadePrestacao());
        $this->assertInstanceOf(Prestador::class, $nfse->getPrestador());
        $this->assertInstanceOf(Rps::class, $nfse->getRps());
        $this->assertInstanceOf(Servico::class, $nfse->getServico());
        $this->assertInstanceOf(Tomador::class, $nfse->getTomador());
        $this->assertInstanceOf(Impressao::class, $nfse->getImpressao());
        $this->assertSame(true, $nfse->getEnviarEmail());
        $this->assertSame('asdf1234', $nfse->getIdIntegracao());
        $this->assertSame(false, $nfse->getSubstituicao());
    }
}
