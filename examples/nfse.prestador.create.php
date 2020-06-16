<?php

require '/home/thiago_ribeiro/Projetos/github.com/plugnotas-php/vendor/autoload.php';

use TecnoSpeed\Plugnotas\Nfse\Prestador;
use TecnoSpeed\Plugnotas\Configuration;
use TecnoSpeed\Plugnotas\Communication\CallApi;

try {
    $prestador = Prestador::fromArray([
        'cpfCnpj' => '80.681.272/0001-33',
        'inscricaoMunicipal' => '123456',
        'razaoSocial' => 'Razao Social do Prestador',
        'simplesNacional' => true,
        'endereco' => [
            'logradouro' => 'Rua de Teste',
            'numero' => '1234',
            'codigoCidade' => '4115200',
            'cep' => '87.050-800',
            'estado' => 'PR',
            'bairro' => 'CENTRO'
        ],
        'nfse' => [
            'ativo' => true
        ]
    ]);

    $configuration = new Configuration(Configuration::TYPE_ENVIRONMENT_SANDBOX);
    $response = $prestador->send($configuration);

    var_dump($response);
} catch (\Exception $e) {
    var_dump($e);
}
