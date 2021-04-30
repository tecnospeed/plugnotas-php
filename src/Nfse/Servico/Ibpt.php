<?php

namespace TecnoSpeed\Plugnotas\Nfse\Servico;

use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Error\ValidationError;


class Ibpt extends BuilderAbstract
{
    private $simplificado;
    private $detalhado;

   

    public function setSimplificado(array $simplificado)
    {
        $this->simplificado = $simplificado;
    }

    public function getSimplificado()
    {
        return $this->simplificado;
    }


    public function setDetalhado(array $detalhado)
    {
  
        $this->detalhado = $detalhado;
    }

    public function getDetalhado()
    {
        return $this->detalhado;
    }

}
