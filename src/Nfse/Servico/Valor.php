<?php

namespace TecnoSpeed\Plugnotas\Nfse\Servico;

use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class Valor
{
    private $baseCalculo;
    private $deducoes;
    private $descontoCondicionado;
    private $descontoIncondicionado;
    private $liquido;
    private $servico;

    public function setBaseCalculo($baseCalculo)
    {
        if (!v::numeric()->validate($baseCalculo)) {
            throw new ValidationError(
                'Base de cálculo deve ser um valor numérico.'
            );
        }
        $this->baseCalculo = $baseCalculo;
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
        $this->deducoes = $deducoes;
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
        $this->descontoCondicionado = $descontoCondicionado;
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
        $this->descontoIncondicionado = $descontoIncondicionado;
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
        $this->liquido = $liquido;
    }

    public function getLiquido()
    {
        return $this->liquido;
    }

    public function setServico($servico)
    {
        if (!v::numeric()->validate($servico)) {
            throw new ValidationError(
                'O valor do serviço deve ser um valor numérico.'
            );
        }
        $this->servico = $servico;
    }

    public function getServico()
    {
        return $this->servico;
    }

}
