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

    $nfse = new Nfse();
    $nfse->setConfiguration($configuration);
    $consulta = $nfse->findByIdOrProtocol('5c3118127ab98414de5e2bd6');
    var_dump($consulta);
} catch (\Exception $e) {
  var_dump($e);
}

