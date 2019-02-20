<?php

namespace TecnoSpeed\Plugnotas\Nfse;

use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class Impressao extends BuilderAbstract
{
    private $camposCustomizados;

    public function setCamposCustomizados($camposCustomizados)
    {
        if (!is_array($camposCustomizados)) {
            throw new ValidationError(
                'camposCustomizados deve ser um array.'
            );
        }

        $this->camposCustomizados = $camposCustomizados;
    }

    public function getCamposCustomizados()
    {
        return $this->camposCustomizados;
    }
}
