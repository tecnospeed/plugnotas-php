<?php

require '../vendor/autoload.php';

use TecnoSpeed\Plugnotas\Configuration;
use TecnoSpeed\Plugnotas\Nfse;

try {
    // Criando configuração (este objeto é onde você irá colocar seu api-key)
    $configuration = new Configuration(
        Configuration::TYPE_ENVIRONMENT_SANDBOX, // Ambiente a ser enviada a requisição
        '2da392a6-79d2-4304-a8b7-959572c7e44d' // API-Key
    );
    $configuration->setNfseDownloadDirectory('./tmp/');

    $nfse = new Nfse();
    $nfse->setConfiguration($configuration);
    $download = $nfse->downloadPdfByCnpjAndIdIntegracao('00000000000191', '000000000001914');
    var_dump($download);
} catch (\Exception $e) {
  var_dump($e);
}

