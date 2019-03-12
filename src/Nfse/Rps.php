<?php

namespace TecnoSpeed\Plugnotas\Nfse;

use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class Rps extends BuilderAbstract
{
    private $dataEmissao;
    private $competencia;

    public function setDataEmissao(\DateTimeInterface $dataEmissao)
    {
        $this->dataEmissao = $dataEmissao->format('Y-m-d\TH:i:s');
    }

    public function getDataEmissao()
    {
        return $this->competencia;
    }

    public function setCompetencia(\DateTimeInterface $competencia)
    {
        $this->competencia = $competencia->format('Y-m-d');
    }

    public function getCompetencia()
    {
        return $this->competencia;
    }
}
