<?php

require '../vendor/autoload.php';

use TecnoSpeed\Plugnotas\Nfse\Prestador;
use TecnoSpeed\Plugnotas\Configuration;
use TecnoSpeed\Plugnotas\Communication\CallApi;

try {
    $prestador = Prestador::fromArray([
        'cpfCnpj' => '00.000.000/0001-91',
        'inscricaoMunicipal' => '123456',
        'razaoSocial' => 'Razao Social do Prestador',
        'endereco' => [
            'logradouro' => 'Rua de Teste',
            'numero' => '1234',
            'codigoCidade' => '4115200',
            'cep' => '87.050-800'
        ]
    ]);

    $configuration = new Configuration();
    $response = $prestador->send($configuration);

    var_dump($response);
} catch (\Exception $e) {
    var_dump($e);
}
