<?php

namespace TecnoSpeed\Plugnotas\Common;

use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class ValorAliquota extends BuilderAbstract
{
    private $aliquota;
    private $valor;

    public function __construct($valor = 0, $aliquota = 0)
    {
        $this->setAliquota($aliquota);
        $this->setValor($valor);
    }

    public function setValor($valor)
    {
        if (!v::numeric()->validate($valor)) {
            throw new ValidationError(
                'Valor deve ser um número.'
            );
        }
        $this->valor = $valor;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setAliquota($aliquota)
    {
        if (!v::numeric()->validate($aliquota)) {
            throw new ValidationError(
                'Aliquota deve ser um número.'
            );
        }
        $this->aliquota = $aliquota;
    }

    public function getAliquota()
    {
        return $this->aliquota;
    }
}
