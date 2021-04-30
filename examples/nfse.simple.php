<?php

require '../vendor/autoload.php';

use TecnoSpeed\Plugnotas\Builders\NfseBuilder;
use TecnoSpeed\Plugnotas\Configuration;
use TecnoSpeed\Plugnotas\Communication\CallApi;

try {
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
        ->withServicos([
            0 => [
                'codigo' => '1.02',
                'discriminacao' => 'Exemplo',
                'cnae' => '4751201',
                'iss' => [
                    'aliquota' => '3'
                ],
                'valor' => [
                    'servico' => 1500.03
                ]
            ]
        ])
        ->build([]);

    $nfse->validate();

    $configuration = new Configuration();
    $response = $nfse->send($configuration);

    var_dump($response);
} catch (\Exception $e) {
    var_dump($e);
}