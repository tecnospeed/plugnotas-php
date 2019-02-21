<?php

require '../vendor/autoload.php';

use TecnoSpeed\Plugnotas\Nfse\Tomador;
use TecnoSpeed\Plugnotas\Configuration;
use TecnoSpeed\Plugnotas\Communication\CallApi;

try {
    $tomador = Tomador::fromArray([
        'cpfCnpj' => '00.000.000/0001-91',
        'razaoSocial' => 'Empresa de teste'
    ]);

    $configuration = new Configuration();
    $response = $tomador->send($configuration);

    var_dump($response);
} catch (\Exception $e) {
    var_dump($e);
}
