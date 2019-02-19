<?php

namespace TecnoSpeed\Plugnotas\Nfse;

use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class CidadePrestacao
{
    private $codigo;
    private $descricao;

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

}
