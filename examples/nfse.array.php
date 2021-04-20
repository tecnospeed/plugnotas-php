<?php

$cidadePrestacao = [
    'codigo' => '',
    'descricao' => ''
];

$impressao = [
    'camposCustomizados' => []
];

$prestador = [
    'certificado' => '',
    'cpfCnpj' => '',
    'email' => '',
    'endereco' => [
        'tipoLogradouro' => '',
        'logradouro' => '',
        'numero' => '',
        'complemento' => '',
        'tipoBairro' => '',
        'bairro' => '',
        'codigoCidade' => '',
        'descricaoCidade' => '',
        'estado' => '',
        'cep' => ''
    ],
    'incentivadorCultural' => '',
    'incentivoFiscal' => '',
    'inscricaoMunicipal' => '',
    'nomeFantasia' => '',
    'razaoSocial' => '',
    'regimeTributario' => '',
    'regimeTributarioEspecial' => '',
    'simplesNacional' => '',
    'telefone' => [
        'ddd' => '',
        'numero' => ''
    ]
];

$rps = [
    'dataEmissao' => new \DateTime(),
    'competencia' => new \DateTime()
];

$servico = [
    0 => [
        'cnae' => '',
        'codigo' => '',
        'codigoCidadeIncidencia' => '',
        'codigoTributacao' => '',
        'deducao' => [
            'descricao' => '',
            'tipo' => ''
        ],
        'descricaoCidadeIncidencia' => '',
        'discriminacao' => '',
        'evento' => [
            'codigo' => '',
            'descricao' => ''
        ],
        'id' => '',
        'idIntegracao' => '',
        'informacoesLegais' => '',
        'iss' => [
            'aliquota' => '',
            'exigibilidade' => '',
            'processoSuspensao' => '',
            'retido' => '',
            'tipoTributacao' => '',
            'valor' => '',
            'valorRetido' => '',
        ],
        'obra' => [
            'art' => '',
            'codigo' => ''
        ],
        'retencao' => [
            'cofins' => [
                'aliquota' => '',
                'valor' => ''
            ],
            'csll' => [
                'aliquota' => '',
                'valor' => ''
            ],
            'inss' => [
                'aliquota' => '',
                'valor' => ''
            ],
            'irrf' => [
                'aliquota' => '',
                'valor' => ''
            ],
            'outrasRetencoes' => '',
            'pis' => [
                'aliquota' => '',
                'valor' => ''
            ]
        ],
        'valor' => [
            'baseCalculo' => '',
            'deducoes' => '',
            'descontoCondicionado' => '',
            'descontoIncondicionado' => '',
            'liquido' => '',
            'servico' => ''
        ],
    ]
];

$tomador = [
    'cpfCnpj' => '',
    'email' => '',
    'endereco' => [
        'tipoLogradouro' => '',
        'logradouro' => '',
        'numero' => '',
        'complemento' => '',
        'tipoBairro' => '',
        'bairro' => '',
        'codigoCidade' => '',
        'descricaoCidade' => '',
        'estado' => '',
        'cep' => ''
    ],
    'inscricaoEstadual' => '',
    'nomeFantasia' => '',
    'razaoSocial' => '',
    'telefone' => [
        'ddd' => '',
        'numero' => ''
    ]
];

$nfse = [
    'cidadePrestacao' => [
        'codigo' => '',
        'descricao' => ''
    ],
    'enviarEmail' => '',
    'idIntegracao' => '',
    'impressao' => [
        'camposCustomizados' => []
    ],
    'prestador' => [
        'certificado' => '',
        'cpfCnpj' => '',
        'email' => '',
        'endereco' => [
            'tipoLogradouro' => '',
            'logradouro' => '',
            'numero' => '',
            'complemento' => '',
            'tipoBairro' => '',
            'bairro' => '',
            'codigoCidade' => '',
            'descricaoCidade' => '',
            'estado' => '',
            'cep' => ''
        ],
        'incentivadorCultural' => '',
        'incentivoFiscal' => '',
        'inscricaoMunicipal' => '',
        'nomeFantasia' => '',
        'razaoSocial' => '',
        'regimeTributario' => '',
        'regimeTributarioEspecial' => '',
        'simplesNacional' => '',
        'telefone' => [
            'ddd' => '',
            'numero' => ''
        ]
    ],
    'rps' => [
        'dataEmissao' => \DateTime(),
        'competencia' => \DateTime()
    ],
    'servico' => [
        0 => [
            'cnae' => '',
            'codigo' => '',
            'codigoCidadeIncidencia' => '',
            'codigoTributacao' => '',
            'deducao' => [
                'descricao' => '',
                'tipo' => ''
            ],
            'descricaoCidadeIncidencia' => '',
            'discriminacao' => '',
            'evento' => [
                'codigo' => '',
                'descricao' => ''
            ],
            'id' => '',
            'idIntegracao' => '',
            'informacoesLegais' => '',
            'iss' => [
                'aliquota' => '',
                'exigibilidade' => '',
                'processoSuspensao' => '',
                'retido' => '',
                'tipoTributacao' => '',
                'valor' => '',
                'valorRetido' => '',
            ],
            'obra' => [
                'art' => '',
                'codigo' => ''
            ],
            'retencao' => [
                'cofins' => [
                    'aliquota' => '',
                    'valor' => ''
                ],
                'csll' => [
                    'aliquota' => '',
                    'valor' => ''
                ],
                'inss' => [
                    'aliquota' => '',
                    'valor' => ''
                ],
                'irrf' => [
                    'aliquota' => '',
                    'valor' => ''
                ],
                'outrasRetencoes' => '',
                'pis' => [
                    'aliquota' => '',
                    'valor' => ''
                ]
            ],
            'valor' => [
                'baseCalculo' => '',
                'deducoes' => '',
                'descontoCondicionado' => '',
                'descontoIncondicionado' => '',
                'liquido' => '',
                'servico' => ''
            ],
        ]
    ],
    'substituicao' => '',
    'tomador' => [
        'cpfCnpj' => '',
        'email' => '',
        'endereco' => [
            'tipoLogradouro' => '',
            'logradouro' => '',
            'numero' => '',
            'complemento' => '',
            'tipoBairro' => '',
            'bairro' => '',
            'codigoCidade' => '',
            'descricaoCidade' => '',
            'estado' => '',
            'cep' => ''
        ],
        'inscricaoEstadual' => '',
        'nomeFantasia' => '',
        'razaoSocial' => '',
        'telefone' => [
            'ddd' => '',
            'numero' => ''
        ]
    ]
];
