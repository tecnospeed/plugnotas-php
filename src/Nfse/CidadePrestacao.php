<?php

namespace TecnoSpeed\Plugnotas\Nfse;

use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Error\ValidationError;


class CidadePrestacao extends BuilderAbstract
{
    private $codigo;
    private $descricao;
    private $tipoLogradouro;
    private $logradouro;
    private $numero;
    private $complemento;
    private $tipoBairro;
    private $bairro;
    private $estado;
    private $cep;


    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setTipoLogradouro($tipoLogradouro)
    {
        $this->tipoLogradouro = $tipoLogradouro;
    }

    public function getTipoLogradouro()
    {
        return $this->tipoLogradouro;
    }
    
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
    }

    public function getLogradouro()
    {
        return $this->logradouro;
    }
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }

    public function getComplemento()
    {
        return $this->complemento;
    }
    public function setTipoBairro($tipoBairro)
    {
        $allowedTypes = [
            'Bairro',
            'Bosque',
            'Chácara',
            'Conjunto',
            'Desmembramento',
            'Distrito',
            'Favela',
            'Fazenda',
            'Gleba',
            'Horto',
            'Jardim',
            'Loteamento',
            'Núcleo',
            'Parque',
            'Residencial',
            'Sítio',
            'Tropical',
            'Vila',
            'Zona',
            'Centro',
            'Setor'
        ];

        if (!in_array($tipoBairro, $allowedTypes)) {
            throw new ValidationError(
                'Tipo de bairro não suportado.'
            );
        }

        $this->tipoBairro = $tipoBairro;
    }

    public function getTipoBairro()
    {
        return $this->tipoBairro;
    }

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setEstado($estado)
    {
        $allowedStates = [
            'AC',
            'AL',
            'AM',
            'AP',
            'BA',
            'CE',
            'DF',
            'ES',
            'GO',
            'MA',
            'MG',
            'MS',
            'MT',
            'PA',
            'PB',
            'PE',
            'PI',
            'PR',
            'RJ',
            'RN',
            'RO',
            'RR',
            'RS',
            'SC',
            'SE',
            'SP',
            'TO'
        ];
        if (!in_array(strtoupper($estado), $allowedStates)) {
            throw new ValidationError(
                'Estado inválido.'
            );
        }

        $this->estado = strtoupper($estado);
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setCep($cep)
    {
        $cepNumbers = preg_replace('/[^0-9]/', '', $cep);
        if (strlen($cepNumbers) !== 8) {
            throw new ValidationError(
                'CEP inválido, por favor verifique se foram informados 8 números.'
            );
        }

        $this->cep = $cepNumbers;
    }

    public function getCep()
    {
        return $this->cep;
    }

}
