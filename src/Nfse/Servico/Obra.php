<?php

namespace TecnoSpeed\Plugnotas\Nfse\Servico;

use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class Obra extends BuilderAbstract
{
    private $art;
    private $codigo;

    public function setArt($art)
    {
        $this->art = $art;
    }

    public function getArt()
    {
        return $this->art;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }
}
