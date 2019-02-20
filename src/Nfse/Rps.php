<?php

namespace TecnoSpeed\Plugnotas\Nfse;

use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class Rps extends BuilderAbstract
{
    private $dataEmissao;
    private $competencia;

    public function setDataEmissao($dataEmissao)
    {
        if (!v::date()->validate($dataEmissao)) {
            throw new ValidationError('dataEmissao deve ser uma data válida.');
        }
        $this->dataEmissao = $dataEmissao;
    }

    public function getDataEmissao()
    {
        return $this->competencia;
    }

    public function setCompetencia($competencia)
    {
        if (!v::date()->validate($competencia)) {
            throw new ValidationError('competencia deve ser uma data válida.');
        }
        $this->competencia = $competencia;
    }

    public function getCompetencia()
    {
        return $this->competencia;
    }
}
