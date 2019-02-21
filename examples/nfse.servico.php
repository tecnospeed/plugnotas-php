<?php

require '../vendor/autoload.php';

use TecnoSpeed\Plugnotas\Nfse\Servico;
use TecnoSpeed\Plugnotas\Configuration;
use TecnoSpeed\Plugnotas\Communication\CallApi;

try {
    $servico = Servico::fromArray([
        'codigo' => '1.02',
        'cnae' => '4751201',
        'iss' => [
            'aliquota' => 3
        ]
    ]);

    $configuration = new Configuration();
    $response = $servico->send($configuration);

    var_dump($response);
} catch (\Exception $e) {
    var_dump($e);
}
