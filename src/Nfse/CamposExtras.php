<?php

namespace TecnoSpeed\Plugnotas\Nfse;

use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class CamposExtras extends BuilderAbstract
{
    private $copiasEmail;

    public function setCopiasEmail($copiasEmail)
    {
        if (!is_array($copiasEmail)) {
            throw new ValidationError(
                'camposCustomizados deve ser um array.'
            );
        }

        $this->copiasEmail = $copiasEmail;
    }

    public function getCopiasEmail()
    {
        return $this->copiasEmail;
    }
}
