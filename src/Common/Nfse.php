<?php

namespace TecnoSpeed\Plugnotas\Common;

use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Error\ValidationError;
use Respect\Validation\Validator as v;

class Nfse extends BuilderAbstract
{
    private $ativo;
    private $tipoContrato;

    public function setAtivo($ativo)
    {
        if (
            is_null($ativo) ||
            !v::boolVal()->validate($ativo)
        ) {
            throw new ValidationError(
                'Ativo é requerido para o cadastro de NFS-e.'
            );
        }

        $this->ativo = $ativo;       
    }

    public function getAtivo()
    {
        return $this->ativo;
    }    

    public function setTipoContrato($tipoContrato)
    {
        if (
            !is_null($tipoContrato) &&
            !($tipoContrato === 0 ||
            $tipoContrato === 1)
        ){
            throw new ValidationError(
                'Valor inválido para o TipoContrato. Valores aceitos: null, 0, 1'
            );            
        }

        $this->tipoContrato = $tipoContrato;        
    }

    public function getTipoContrato()
    {
        return $this->tipoContrato;
    }  
}
