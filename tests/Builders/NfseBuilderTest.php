<?php
namespace TecnoSpeed\Plugnotas\Tests\Builders;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Builders\NfseBuilder;
use TecnoSpeed\Plugnotas\Common\Endereco;
use TecnoSpeed\Plugnotas\Common\Telefone;
use TecnoSpeed\Plugnotas\Common\Nfse;
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
    /**
     * @covers TecnoSpeed\Plugnotas\Builders\NfseBuilder::withCidadePrestacao
     * @covers TecnoSpeed\Plugnotas\Builders\NfseBuilder::build
     */
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

    /**
     * @covers TecnoSpeed\Plugnotas\Builders\NfseBuilder::withCidadePrestacao
     * @covers TecnoSpeed\Plugnotas\Builders\NfseBuilder::build
     */
    public function testWithOneObject()
    {
        $nfse = (new NfseBuilder)
            ->withCidadePrestacao(CidadePrestacao::fromArray([
                'codigo' => '123'
            ]))
            ->build();
        $this->assertInstanceOf(CidadePrestacao::class, $nfse->getCidadePrestacao());
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Builders\NfseBuilder::build
     * @covers TecnoSpeed\Plugnotas\Builders\NfseBuilder::callFromArray
     * @covers TecnoSpeed\Plugnotas\Builders\NfseBuilder::withRps
     */
    public function testWithRpsObject()
    {
        $dateCompare = new \DateTime('now');
        $rps = new Rps();
        $rps->setDataEmissao($dateCompare);
        $rps->setCompetencia($dateCompare);

        $nfse = (new NfseBuilder)
            ->withRps($rps)
            ->build();

        $this->assertInstanceOf(Rps::class, $nfse->getRps());
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Builders\NfseBuilder::build
     * @covers TecnoSpeed\Plugnotas\Builders\NfseBuilder::callFromArray
     * @covers TecnoSpeed\Plugnotas\Builders\NfseBuilder::withRps
     */
    public function testWithInvalidTypeObject()
    {
        $this->expectException(InvalidTypeError::class);
        $this->expectExceptionMessage(
            'Deve ser informado um array ou um objeto do tipo: ' . Prestador::class
        );

        $dateCompare = new \DateTime('now');
        $rps = new Rps();
        $rps->setDataEmissao($dateCompare);
        $rps->setCompetencia($dateCompare);

        $nfse = (new NfseBuilder)
            ->withPrestador($rps)
            ->build();
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Builders\NfseBuilder::build
     * @covers TecnoSpeed\Plugnotas\Builders\NfseBuilder::callFromArray
     * @covers TecnoSpeed\Plugnotas\Builders\NfseBuilder::withCidadePrestacao
     * @covers TecnoSpeed\Plugnotas\Builders\NfseBuilder::withImpressao
     * @covers TecnoSpeed\Plugnotas\Builders\NfseBuilder::withPrestador
     * @covers TecnoSpeed\Plugnotas\Builders\NfseBuilder::withRps
     * @covers TecnoSpeed\Plugnotas\Builders\NfseBuilder::withServicos
     * @covers TecnoSpeed\Plugnotas\Builders\NfseBuilder::withTomador
     */
    public function testWithValidData()
    {
        $services = [];
        array_push($services, [
            'codigo' => 'codigo',
            'discriminacao' => 'discriminação',
            'codigoTributacao' => null,
            'cnae' => 'cnae',
            'iss' => [
                'aliquota' => 1.01
            ],
            'valor' => [
                'servico' => 10
            ]
        ]);

        array_push($services, [
            'codigo' => 'codigo2',
            'discriminacao' => 'discriminação2',
            'codigoTributacao' => null,
            'cnae' => 'cnae2',
            'iss' => [
                'aliquota' => 1.01
            ],
            'valor' => [
                'servico' => 10
            ]
        ]);

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
            ->withServicos($services)
            ->withRps([
                'dataEmissao' => new \DateTime('2019-02-27')
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
        $this->assertEquals([
            [
                'codigo' => 'codigo',
                'discriminacao' => 'discriminação',
                'cnae' => 'cnae',
                'iss' => [
                    'aliquota' => 1.01,
                    "exigibilidade" => null,
                    "processoSuspensao" => null,
                    "retido" => null,
                    "tipoTributacao" => null,
                    "valor" => null,
                    "valorRetido" => null,
                ],
                'valor' => [
                    'servico' => 10,
                    "baseCalculo" => null,
                    "deducoes" => null,
                    "descontoCondicionado" => null,
                    "descontoIncondicionado" => null,
                    "liquido" =>null,
                    'unitario' => null,
                    'valorAproximadoTributos' => null
                ]
            ],
            [
                'codigo' => 'codigo2',
                'discriminacao' => 'discriminação2',
                'cnae' => 'cnae2',
                'iss' => [
                    'aliquota' => 1.01,
                    "exigibilidade" => null,
                    "processoSuspensao" => null,
                    "retido" => null,
                    "tipoTributacao" => null,
                    "valor" => null,
                    "valorRetido" => null,
                ],
                'valor' => [
                    'servico' => 10,
                    "baseCalculo" => null,
                    "deducoes" => null,
                    "descontoCondicionado" => null,
                    "descontoIncondicionado" => null,
                    "liquido" =>null,
                    'unitario' => null,
                    'valorAproximadoTributos' => null

                ]
            ]
        ], $nfse->getServico());
        $this->assertInstanceOf(Tomador::class, $nfse->getTomador());
        $this->assertInstanceOf(Impressao::class, $nfse->getImpressao());
        $this->assertSame(true, $nfse->getEnviarEmail());
        $this->assertSame('asdf1234', $nfse->getIdIntegracao());
        $this->assertSame(false, $nfse->getSubstituicao());
    }
}