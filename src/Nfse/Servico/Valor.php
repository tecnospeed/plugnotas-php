<?php

namespace TecnoSpeed\Plugnotas\Nfse\Servico;

use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class Valor extends BuilderAbstract
{
    private $servico;
    private $baseCalculo;
    private $deducoes;
    private $descontoCondicionado;
    private $descontoIncondicionado;
    private $liquido;
    private $unitario;
    private $valorAproximadoTributos;


    public function setServico($servico)
    {
        if (!v::numeric()->validate($servico)) {
            throw new ValidationError(
                'O valor do serviço deve ser um valor numérico.'
            );
        }
        $this->servico = (float)$servico;
    }

    public function getServico()
    {
        return $this->servico;
    }

    public function setBaseCalculo($baseCalculo)
    {
        if (!v::numeric()->validate($baseCalculo)) {
            throw new ValidationError(
                'Base de cálculo deve ser um valor numérico.'
            );
        }
        $this->baseCalculo = (float)$baseCalculo;
    }

    public function getBaseCalculo()
    {
        return $this->baseCalculo;
    }

    public function setDeducoes($deducoes)
    {
        if (!v::numeric()->validate($deducoes)) {
            throw new ValidationError(
                'Deduções deve ser um valor numérico.'
            );
        }
        $this->deducoes = (float)$deducoes;
    }

    public function getDeducoes()
    {
        return $this->deducoes;
    }

    public function setDescontoCondicionado($descontoCondicionado)
    {
        if (!v::numeric()->validate($descontoCondicionado)) {
            throw new ValidationError(
                'Desconto condicional deve ser um valor numérico.'
            );
        }
        $this->descontoCondicionado = (float)$descontoCondicionado;
    }

    public function getDescontoCondicionado()
    {
        return $this->descontoCondicionado;
    }

    public function setDescontoIncondicionado($descontoIncondicionado)
    {
        if (!v::numeric()->validate($descontoIncondicionado)) {
            throw new ValidationError(
                'Desconto incondicional deve ser um valor numérico.'
            );
        }
        $this->descontoIncondicionado = (float)$descontoIncondicionado;
    }

    public function getDescontoIncondicionado()
    {
        return $this->descontoIncondicionado;
    }

    public function setLiquido($liquido)
    {
        if (!v::numeric()->validate($liquido)) {
            throw new ValidationError(
                'Valor líquido deve ser um valor numérico.'
            );
        }
        $this->liquido = (float)$liquido;
    }

    public function getLiquido()
    {
        return $this->liquido;
    }

    public function setUnitario($unitario)
    {
        if (!v::numeric()->validate($unitario)) {
            throw new ValidationError(
                'Valor unitário do serviço, referente a unidade informada.'
            );
        }
        $this->unitario = (float)$unitario;
    }

    public function getUnitario()
    {
        return $this->unitario;
    }

    public function setValorAproximadoTributos($valorAproximadoTributos)
    {
        if (!v::numeric()->validate($valorAproximadoTributos)) {
            throw new ValidationError(
                'Valor aproximado dos tributos. Campo utilizado somente para NFS-e de Brasília.'
            );
        }
        $this->valorAproximadoTributos = (float)$valorAproximadoTributos;
    }

    public function getValorAproximadoTributos()
    {
        return $this->valorAproximadoTributos;
    }

    

}
