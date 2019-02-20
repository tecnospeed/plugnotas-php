<?php

namespace TecnoSpeed\Plugnotas\Nfse;

use TecnoSpeed\Plugnotas\Nfse;
use TecnoSpeed\Plugnotas\Nfse\Tomador;
use TecnoSpeed\Plugnotas\Error\InvalidTypeError;

class NfseBuilder
{
    private $nfse;

    public function __construct()
    {
        $this->nfse = new Nfse;
        return $this;
    }

    public function withTomador($tomador)
    {
        if (is_array($tomador)) {
            $tomadorObject = Tomador::fromArray($tomador);
            $this->nfse->setTomador($tomadorObject);
            return $this;
        }

        if (get_class($tomador) === Tomador::class) {
            $this->nfse->setTomador($tomador);
            return $this;
        }

        throw new InvalidTypeError(
            'Deve ser informado um array ou um objeto do tipo Tomador.'
        );
    }
}

$prestador = [
    'cpfCnpj' => ''
    'inscricaoMunicipal' => ''
    'razaoSocial' => ''
    'simplesNacional' => ''
    'endereco' => [
        'logradouro' => '',
        'numero' => '',
        'codigoCidade' => '',
        'cep' => ''
    ]
];

$tomador = [
    'cpfCnpj' => '',
    'razaoSocial' => ''
];

$servico = [
    'codigo' => '',
    'discriminacao' => '',
    'cnae' => '',
    'iss' => [
        'aliquota' => ''
    ],
    'valor' => [
        'servico' => ''
    ]
];
