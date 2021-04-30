<?php

namespace TecnoSpeed\Plugnotas\Nfse;

use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class Rps extends BuilderAbstract
{
    private $dataEmissao;
    private $competencia;
    private $dataVencimento;

    public function setDataEmissao(\DateTimeInterface $dataEmissao)
    {
        $this->dataEmissao = $dataEmissao->format('Y-m-d\TH:i:s');
    }

    public function getDataEmissao()
    {
        return $this->dataEmissao;
    }

    public function setCompetencia(\DateTimeInterface $competencia)
    {
        $this->competencia = $competencia->format('Y-m-d');
    }

    public function getCompetencia()
    {
        return $this->competencia;
    }
    public function setDataVencimento(\DateTimeInterface $dataVencimento)
    {
        $this->dataVencimento = $dataVencimento->format('Y-m-d\TH:i:s');
    }

    public function getDataVencimento()
    {
        return $this->dataVencimento;
    }
}
