<?php

namespace TecnoSpeed\Plugnotas\Nfse\Servico;

use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class Deducao extends BuilderAbstract
{
    private $descricao;
    private $tipo;

    public function setTipo($tipo)
    {
        if (!v::in([0, 1, 2, 3, 4, 5, 6, 7, 8, 99])->validate($tipo)) {
            throw new ValidationError(
                'Tipo inválido.'
            );
        }
        $this->tipo = $tipo;
    }

    public function getTipo()
    {
        return $this->tipo;
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
