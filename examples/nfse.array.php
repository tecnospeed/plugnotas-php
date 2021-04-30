<?php

$cidadePrestacao = [
    'codigo' => '',
    'descricao' => '',
    'tipoLogradouro' =>'',
    'logradouro'=>'',
    'numero'=>'',
    'complemento' => '',
    'tipoBairro' => '',
    'bairro' => '',
    'estado'=>'',
    'cep'=>''
];

$impressao = [
    'camposCustomizados' => []
];

$prestador = [
    'cpfCnpj' => '',
    'inscricaoMunicipal'=>'',
    'inscricaoEstadual' => '',
    'razaoSocial' => '',
    'nomeFantasia' => '',
    'simplesNacional' => '',
    'regimeTributario' => '',
    'incentivoFiscal' => '',
    'incentivadorCultural' => '',
    'regimeTributarioEspecial' => '',
    'endereco' => [
        'tipoLogradouro' => '',
        'logradouro' => '',
        'numero' => '',
        'complemento' => '',
        'tipoBairro' => '',
        'bairro' => '',
        'codigoPais'=>'',
        'descricaoPais'=>'',
        'codigoCidade' => '',
        'descricaoCidade' => '',
        'estado' => '',
        'cep' => ''
    ],
    'telefone' => [
        'ddd' => '',
        'numero' => ''
    ],
    'email' => '',
];

$rps = [
    'dataEmissao' => new \DateTime(),
    'competencia' => new \DateTime(),
    'dataVencimento' => new \DateTime()
];

$servico = [
    0 => [
        'codigo' => '',
        'idIntegracao' => '',
        'discriminacao' => '',
        'codigoTributacao' => '',
        'cnae' => '',
        'codigoCidadeIncidencia' => '',
        'descricaoCidadeIncidencia' => '',
        'unidade'=>'',
        'quantidade' => '',
        'iss' => [
            'tipoTributacao' => '',
            'exigibilidade' => '',
            'retido' => '',
            'aliquota' => '',
            'valor' => '',
            'valorRetido' => '',
            'processoSuspensao' => '',
        ],
        'obra' => [
            'art' => '',
            'codigo' => '',
            'cei'=>''
        ],
        'valor' => [
            'servico' => '',
            'baseCalculo' => '',
            'deducoes' => '',
            'descontoCondicionado' => '',
            'descontoIncondicionado' => '',
            'liquido' => '',
            'unitario' => '',
            'valorAproximadoTributos' => ''
        ],
        'deducao' => [
            'tipo' => '',
            'descricao' => ''
        ],
        'retencao' => [
            'pis' => [
                'aliquota' => '',
                'valor' => '',
                'cst'=>''
            ],
            'cofins' => [
                'aliquota' => '',
                'valor' => '',
                'cst'=>''
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
            'cpp' => [
                'aliquota' => '',
                'valor' => ''
            ]
            
        ],
        'tributavel'=>'',
        'ibpt' =>[
            'simplificado' => [
                'aliquota' => '',
            ],
            'detalhado' => [
                'aliquota' => [
                    'municipal' => '',
                    'estadual' => '',
                    'federal' =>''
                ],
                ]    
        ],
        'responsavelRetencao'=>''
    ]
];

$tomador = [
    'cpfCnpj' => '',
    'inscricaoMunicipal'=>'',
    'inscricaoEstadual' => '',
    'inscricaoSuframa'=>'',
    'indicadorInscricaoEstadual' =>'',
    'razaoSocial' => '',
    'nomeFantasia' => '',
    'endereco' => [
        'tipoLogradouro' => '',
        'logradouro' => '',
        'numero' => '',
        'complemento' => '',
        'tipoBairro' => '',
        'bairro' => '',
        'codigoPais'=>'',
        'descricaoPais'=>'',
        'codigoCidade' => '',
        'descricaoCidade' => '',
        'estado' => '',
        'cep' => ''
    ],
    'telefone' => [
        'ddd' => '',
        'numero' => ''
    ],
    'email' => '',
    'orgaoPublico'=>'',
];

$intermediario = [
    'tipo' =>'',
    'cpfCnpj' => '',
    'razaoSocial' => '',
    'inscricaoMunicipal' => ''


];

$cargaTributaria =[
    'valor'=>'',
    'percentual'=>'',
    'fonte'=>'',

];

$camposExtras =[
    'copiasEmail' => []
];

$parcelas=[
    'tipoPagamento'=> '',
    'numero'=> '',
    'dataVencimento'=> '',
    'valor'=> ''
];


$nfse = [
    'idIntegracao' => '',
    'enviarEmail' => '',
    'rps' => [
        'dataEmissao' => \DateTime(),
        'competencia' => \DateTime(),
        'dataVencimento' => \DateTime()
    ],
    'cidadePrestacao' => [
        'codigo' => '',
        'descricao' => '',
        'tipoLogradouro' =>'',
        'logradouro'=>'',
        'numero'=>'',
        'complemento' => '',
        'tipoBairro' => '',
        'bairro' => '',
        'estado'=>'',
        'cep'=>''
    ],
    'idNotaSubstituida' => '',
    'naturezaTributacao' => '',
    'prestador' => [
        'cpfCnpj' => '',
        'inscricaoMunicipal'=>'',
        'inscricaoEstadual' => '',
        'razaoSocial' => '',
        'nomeFantasia' => '',
        'simplesNacional' => '',
        'regimeTributario' => '',
        'incentivoFiscal' => '',
        'incentivadorCultural' => '',
        'regimeTributarioEspecial' => '',
        'endereco' => [
            'tipoLogradouro' => '',
            'logradouro' => '',
            'numero' => '',
            'complemento' => '',
            'tipoBairro' => '',
            'bairro' => '',
            'codigoPais'=>'',
            'descricaoPais'=>'',
            'codigoCidade' => '',
            'descricaoCidade' => '',
            'estado' => '',
            'cep' => ''
        ],
        'telefone' => [
            'ddd' => '',
            'numero' => ''
        ],
        'email' => '',
    ],
    'tomador' => [
        'cpfCnpj' => '',
        'inscricaoMunicipal'=>'',
        'inscricaoEstadual' => '',
        'inscricaoSuframa'=>'',
        'indicadorInscricaoEstadual' =>'',
        'razaoSocial' => '',
        'nomeFantasia' => '',
        'endereco' => [
            'tipoLogradouro' => '',
            'logradouro' => '',
            'numero' => '',
            'complemento' => '',
            'tipoBairro' => '',
            'bairro' => '',
            'codigoPais'=>'',
            'descricaoPais'=>'',
            'codigoCidade' => '',
            'descricaoCidade' => '',
            'estado' => '',
            'cep' => ''
        ],
        'telefone' => [
            'ddd' => '',
            'numero' => ''
        ],
        'email' => '',
        'orgaoPublico'=>'',
    ],
    'intermediario'=>[
        'tipo' =>'',
        'cpfCnpj' => '',
        'razaoSocial' => '',
        'inscricaoMunicipal' => ''
    ], 
    'servico' => [
        0 => [
            'codigo' => '',
            'idIntegracao' => '',
            'discriminacao' => '',
            'codigoTributacao' => '',
            'cnae' => '',
            'codigoCidadeIncidencia' => '',
            'descricaoCidadeIncidencia' => '',
            'unidade'=>'',
            'quantidade' => '',
            'iss' => [
                'tipoTributacao' => '',
                'exigibilidade' => '',
                'retido' => '',
                'aliquota' => '',
                'valor' => '',
                'valorRetido' => '',
                'processoSuspensao' => '',
            ],
            'obra' => [
                'art' => '',
                'codigo' => '',
                'cei'=>''
            ],
            'valor' => [
                'servico' => '',
                'baseCalculo' => '',
                'deducoes' => '',
                'descontoCondicionado' => '',
                'descontoIncondicionado' => '',
                'liquido' => '',
                'unitario' => '',
                'valorAproximadoTributos' => ''
            ],
            'deducao' => [
                'tipo' => '',
                'descricao' => ''
            ],
            'retencao' => [
                'pis' => [
                    'aliquota' => '',
                    'valor' => '',
                    'cst'=>''
                ],
                'cofins' => [
                    'aliquota' => '',
                    'valor' => '',
                    'cst'=>''
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
                'cpp' => [
                    'aliquota' => '',
                    'valor' => ''
                ]
                
            ],
            'tributavel'=>'',
            'ibpt' =>[
                'simplificado' => [
                    'aliquota' => '',
                ],
                'detalhado' => [
                    'aliquota' => [
                        'municipal' => '',
                        'estadual' => '',
                        'federal' =>''
                    ],
                    ]    
            ],
            'responsavelRetencao'=>''
        ]
    ],

    'cargaTributaria'=>[
        'valor'=>'',
        'percentual'=>'',
        'fonte'=>'',
    ],
    'impressao' => [
        'camposCustomizados' => []
    ],
    'descricao' => '',
    'camposExtras' =>[
        'copiasEmail'=>[]
    ],
    'informacoesComplementares'=>'',
    'parcelas'=>[
       'tipoPagamento'=> '',
       'numero'=> '',
       'dataVencimento'=> '',
       'valor'=> ''
    ]
];
