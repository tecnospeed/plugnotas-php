<?php

namespace TecnoSpeed\Plugnotas\Nfse;

use FerFabricio\Hydrator\Hydrate;
use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Configuration;
use TecnoSpeed\Plugnotas\Communication\CallApi;
use TecnoSpeed\Plugnotas\Error\RequiredError;
use TecnoSpeed\Plugnotas\Error\ValidationError;
use TecnoSpeed\Plugnotas\Nfse\Servico\Deducao;
use TecnoSpeed\Plugnotas\Nfse\Servico\Evento;
use TecnoSpeed\Plugnotas\Nfse\Servico\Iss;
use TecnoSpeed\Plugnotas\Nfse\Servico\Obra;
use TecnoSpeed\Plugnotas\Nfse\Servico\Retencao;
use TecnoSpeed\Plugnotas\Nfse\Servico\Valor;
use TecnoSpeed\Plugnotas\Nfse\Servico\Ibpt;
use TecnoSpeed\Plugnotas\Traits\Communication;

class Servico extends BuilderAbstract
{
    use Communication;

    private $cnae;
    private $codigo;
    private $codigoCidadeIncidencia;
    private $codigoTributacao;
    private $deducao;
    private $descricaoCidadeIncidencia;
    private $discriminacao;
    private $evento;
    private $id;
    private $idIntegracao;
    private $informacoesLegais;
    private $iss;
    private $obra;
    private $retencao;
    private $valor;
    private $unidade;
    private $quantidade;
    private $tributavel;
    private $responsavelRetencao;
    private $ibpt;


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

    public function setDeducao(Deducao $deducao)
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

    public function setEvento(Evento $evento)
    {
        $this->evento = $evento;
    }

    public function getEvento()
    {
        return $this->evento;
    }

    public function setId($id)
    {
        $idFiltered = preg_replace('/[^0-9a-f]/', '', strtolower((string)$id));
        if (strlen($idFiltered) !== 24) {
            throw new ValidationError(
                'Id inválido.'
            );
        }

        $this->id = $idFiltered;
    }

    public function getId()
    {
        return $this->id;
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

    public function setObra(Obra $obra)
    {  
        $this->obra = $obra;
    }

    public function getObra()
    {
        return $this->obra;
    }

    public function setRetencao(Retencao $retencao)
    {
        $this->retencao = $retencao;
    }

    public function getRetencao()
    {
        return $this->retencao;
    }

    public function setValor(Valor $valor)
    {
        $this->valor = $valor;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setUnidade($unidade)
    {
        $this->unidade = $unidade;
    }

    public function getUnidade()
    {
        return $this->unidade;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setTributavel($tributavel)
    {
        $this->tributavel = $tributavel;
    }

    public function getTributavel()
    {
        return $this->tributavel;
    }

    public function setResponsavelRetencao($responsavelRetencao){
    if (!v::in([1,2])->validate($responsavelRetencao)) {
        throw new ValidationError(
            'Responsável Retencao inválido.'
        );
    }
    $this->responsavelRetencao = $responsavelRetencao;
 
    }

    public function getResponsavelRetencao()
    {
        return $this->responsavelRetencao;
    }
    public function setIbpt(Ibpt $ibpt)
    {
        $this->ibpt = $ibpt;
    }

    public function getIbpt()
    {
        return $this->ibpt;
    }

    public function validate()
    {
        $data = $this->toArray();
        if(
            !v::allOf(
                v::keyNested('codigo'),
                v::keyNested('cnae'),
                v::keyNested('iss.aliquota')
            )->validate($data)
        ) {
            throw new RequiredError(
                'Os parâmetros mínimos para criar um Serviço não foram preenchidos.'
            );
        }

        return true;
    }

    public function send(Configuration $configuration)
    {
        $this->validate();

        $communication = $this->getCallApiInstance($configuration);
        return $communication->send('POST', '/nfse/servico', $this->toArray(true));
    }

    public static function fromArray($data)
    {
        if (array_key_exists('deducao', $data)) {
            $data['deducao'] = Deducao::fromArray($data['deducao']);
        }

        if (array_key_exists('evento', $data)) {
            $data['evento'] = Evento::fromArray($data['evento']);
        }

        if (array_key_exists('iss', $data)) {
            $data['iss'] = Iss::fromArray($data['iss']);
        }

        if (array_key_exists('obra', $data)) {
            $data['obra'] = Obra::fromArray($data['obra']);
        }

        if (array_key_exists('retencao', $data)) {
            $data['retencao'] = Retencao::fromArray($data['retencao']);
        }

        if (array_key_exists('valor', $data)) {
            $data['valor'] = Valor::fromArray($data['valor']);
        }
        if (array_key_exists('ibpt', $data)) {
            $data['ibpt'] = Ibpt::fromArray($data['ibpt']);
        }

        return Hydrate::toObject(Servico::class, $data);
    }
}
