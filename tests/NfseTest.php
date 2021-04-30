<?php

namespace TecnoSpeed\Plugnotas\Tests;


use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Builders\NfseBuilder;
use TecnoSpeed\Plugnotas\Common\Endereco;
use TecnoSpeed\Plugnotas\Common\Telefone;
use TecnoSpeed\Plugnotas\Common\ValorAliquota;
use TecnoSpeed\Plugnotas\Configuration;
use TecnoSpeed\Plugnotas\Error\RequiredError;
use TecnoSpeed\Plugnotas\Error\ValidationError;
use TecnoSpeed\Plugnotas\Nfse;
use TecnoSpeed\Plugnotas\Nfse\CidadePrestacao;
use TecnoSpeed\Plugnotas\Nfse\Impressao;
use TecnoSpeed\Plugnotas\Nfse\Prestador;
use TecnoSpeed\Plugnotas\Nfse\Rps;
use TecnoSpeed\Plugnotas\Nfse\Servico;
use TecnoSpeed\Plugnotas\Nfse\Servico\Deducao;
use TecnoSpeed\Plugnotas\Nfse\Servico\Evento;
use TecnoSpeed\Plugnotas\Nfse\Servico\Iss;
use TecnoSpeed\Plugnotas\Nfse\Servico\Obra;
use TecnoSpeed\Plugnotas\Nfse\Servico\Retencao;
use TecnoSpeed\Plugnotas\Nfse\Servico\Valor;
use TecnoSpeed\Plugnotas\Nfse\Tomador;

class NfseTest extends TestCase
{

    public function testValidateWithValidData()
    {
        $services = [];
        array_push($services, [
            'codigo' => 'codigo',
            'discriminacao' => 'discriminação',
            'cnae' => 'cnae',
            'iss' => [
                'aliquota' => 1.01
            ],
            'valor' => [
                'servico' => 10
            ]
        ]);

        $nfse = (new NfseBuilder)
            ->withPrestador([
                'cpfCnpj' => '00.000.000/0001-91',
                'inscricaoMunicipal' => '123456',
                'razaoSocial' => 'Razao Social do Prestador',
                'endereco' => [
                    'logradouro' => 'Rua de Teste',
                    'numero' => '1234',
                    'codigoCidade' => '4115200',
                    'cep' => '87.050-800'
                ]
            ])
            ->withTomador([
                'cpfCnpj' => '000.000.001-91',
                'razaoSocial' => 'Razao Social do Tomador'
            ])
            ->withServicos($services)
            ->build([]);
        $this->assertTrue($nfse->validate());
    }
}