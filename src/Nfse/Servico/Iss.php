<?php

namespace TecnoSpeed\Plugnotas\Nfse\Servico;

use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class Iss extends BuilderAbstract
{
    private $aliquota;
    private $exigibilidade;
    private $processoSuspensao;
    private $retido;
    private $tipoTributacao;
    private $valor;
    private $valorRetido;

    public function setAliquota($aliquota)
    {
        if (!v::numeric()->validate($aliquota)) {
            throw new ValidationError(
                'É necessário informar um valor numérico para aliquota.'
            );
        }
        $this->aliquota = (float)$aliquota;
    }

    public function getAliquota()
    {
        return $this->aliquota;
    }

    public function setExigibilidade($exigibilidade)
    {
        if (!v::in([1, 2, 3, 4, 5, 6, 7])->validate($exigibilidade)) {
            throw new ValidationError(
                'Exigibilidade inválida.'
            );
        }
        $this->exigibilidade = $exigibilidade;
    }

    public function getExigibilidade()
    {
        return $this->exigibilidade;
    }

    public function setProcessoSuspensao($processoSuspensao)
    {
        $this->processoSuspensao = $processoSuspensao;
    }

    public function getProcessoSuspensao()
    {
        return $this->processoSuspensao;
    }

    public function setRetido($retido)
    {
        if (!v::boolVal()->validate($retido)) {
            throw new ValidationError(
                'Retido deve ser um valor booleano.'
            );
        }
        $this->retido = (bool)$retido;
    }

    public function getRetido()
    {
        return $this->retido;
    }

    public function setTipoTributacao($tipoTributacao)
    {
        if (!v::in([1, 2, 3, 4, 5, 6, 7])->validate($tipoTributacao)) {
            throw new ValidationError(
                'Tipo de tributação inválido.'
            );
        }
        $this->tipoTributacao = $tipoTributacao;
    }

    public function getTipoTributacao()
    {
        return $this->tipoTributacao;
    }

    public function setValor($valor)
    {
        if (!v::numeric()->validate($valor)) {
            throw new ValidationError(
                'É necessário informar um valor numérico para o campo valor.'
            );
        }
        $this->valor = (float)$valor;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setValorRetido($valorRetido)
    {
        if (!v::numeric()->validate($valorRetido)) {
            throw new ValidationError(
                'É necessário informar um valor numérico para o campo valorRetido.'
            );
        }
        $this->valorRetido = (float)$valorRetido;
    }

    public function getValorRetido()
    {
        return $this->valorRetido;
    }
}
