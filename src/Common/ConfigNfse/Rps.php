<?php

namespace TecnoSpeed\Plugnotas\Common\ConfigNfse;

use Respect\Validation\Validator as v;

use TecnoSpeed\Plugnotas\Error\ValidationError;
use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;

class Rps extends BuilderAbstract
{
    private $serie;
    private $numero;
    private $lote;

    public function setSerie($serie)
    {
        if(
            !is_null($serie) &&
            !v::stringType()->validate($serie)
        ) {
            throw new ValidationError(
                'Serie tem que ser um valor string'
            );
        }

        $this->serie = $serie;
    }

    public function getSerie()
    {
        return $this->serie;
    }

    public function setNumero($numero)
    {
        if(
            !is_null($numero) &&
            !v::intType()->validate($numero)
        ) {
            throw new ValidationError(
                'Numero tem que ser um valor inteiro'
            );
        }

        $this->numero = $numero;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setLote($lote)
    {
        if(
            !is_null($lote) &&
            !v::intType()->validate($lote)
        ) {
            throw new ValidationError(
                'Lote tem que ser um valor inteiro'
            );
        }

        $this->lote = $lote;
    }

    public function getLote()
    {
        return $this->lote;
    }
}
