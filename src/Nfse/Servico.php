<?php

namespace TecnoSpeed\Plugnotas\Nfse;

use TecnoSpeed\Plugnotas\Common\Retencao;
use TecnoSpeed\Plugnotas\Nfse\Iss;

class Servico
{
    private $cnae;
    private $codigo;
    private $codigoCidadeIncidencia;
    private $codigoTributacao;
    private $deducao;
    private $descricaoCidadeIncidencia;
    private $discriminacao;
    private $evento;
    private $idIntegracao;
    private $informacoesLegais;
    private $iss;
    private $obra;
    private $retencao;
    private $valor;

    public function setCnae($cnae)
    {
        $this->cnae = $cnae;
    }

    public function getCnae()
    {
        return $this->cnae;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigoCidadeIncidencia($codigoCidadeIncidencia)
    {
        $this->codigoCidadeIncidencia = $codigoCidadeIncidencia;
    }

    public function getCodigoCidadeIncidencia()
    {
        return $this->codigoCidadeIncidencia;
    }

    public function setCodigoTributacao($codigoTributacao)
    {
        $this->codigoTributacao = $codigoTributacao;
    }

    public function getCodigoTributacao()
    {
        return $this->codigoTributacao;
    }

    public function setDeducao($deducao)
    {
        $this->deducao = $deducao;
    }

    public function getDeducao()
    {
        return $this->deducao;
    }

    public function setDescricaoCidadeIncidencia($descricaoCidadeIncidencia)
    {
        $this->descricaoCidadeIncidencia = $descricaoCidadeIncidencia;
    }

    public function getDescricaoCidadeIncidencia()
    {
        return $this->descricaoCidadeIncidencia;
    }

    public function setDiscriminacao($discriminacao)
    {
        $this->discriminacao = $discriminacao;
    }

    public function getDiscriminacao()
    {
        return $this->discriminacao;
    }

    public function setEvento($evento)
    {
        $this->evento = $evento;
    }

    public function getEvento()
    {
        return $this->evento;
    }

    public function setIdIntegracao($idIntegracao)
    {
        $this->idIntegracao = $idIntegracao;
    }

    public function getIdIntegracao()
    {
        return $this->idIntegracao;
    }

    public function setInformacoesLegais($informacoesLegais)
    {
        $this->informacoesLegais = $informacoesLegais;
    }

    public function getInformacoesLegais()
    {
        return $this->informacoesLegais;
    }

    public function setIss(Iss $iss)
    {
        $this->iss = $iss;
    }

    public function getIss()
    {
        return $this->iss;
    }

    public function setObra($obra)
    {
        $this->obra = $obra;
    }

    public function getObra()
    {
        return $this->obra;
    }

    public function setRetencao($retencao)
    {
        $this->retencao = $retencao;
    }

    public function getRetencao()
    {
        return $this->retencao;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function getValor()
    {
        return $this->valor;
    }

}
