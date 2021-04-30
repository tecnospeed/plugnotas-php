<?php

namespace TecnoSpeed\Plugnotas\Common;

use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class Endereco extends BuilderAbstract
{
    private $tipoLogradouro;
    private $logradouro;
    private $numero;
    private $complemento;
    private $tipoBairro;
    private $bairro;
    private $codigoPais;
    private $descricaoPais;
    private $codigoCidade;
    private $descricaoCidade;
    private $estado;
    private $cep;

    public function getTipoLogradouro()
    {
        return $this->tipoLogradouro;
    }

    public function setTipoLogradouro($tipoLogradouro)
    {
        $allowedTypes = [
            'Alameda',
            'Avenida',
            'Chácara',
            'Colônia',
            'Condomínio',
            'Estância',
            'Estrada',
            'Fazenda',
            'Praça',
            'Prolongamento',
            'Rodovia',
            'Rua',
            'Sítio',
            'Travessa',
            'Vicinal'
        ];

        if (!in_array($tipoLogradouro, $allowedTypes)) {
            throw new ValidationError(
                'Tipo de logradouro não suportado.'
            );
        }

        $this->tipoLogradouro = $tipoLogradouro;
    }

    public function getLogradouro()
    {
        return $this->logradouro;
    }

    public function setLogradouro($logradouro)
    {
        if (!strlen($logradouro) > 0) {
            throw new ValidationError(
                'Logradouro é um campo requerido.'
            );
        }

        $this->logradouro = $logradouro;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        if (!strlen($numero) > 0) {
            throw new ValidationError(
                'Número é um campo requerido.'
            );
        }

        $this->numero = $numero;
    }

    public function getComplemento()
    {
        return $this->complemento;
    }

    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }

    public function getTipoBairro()
    {
        return $this->tipoBairro;
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

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    public function getCodigoPais()
    {
        return $this->codigoPais;
    }

    public function setCodigoPais($codigoPais)
    {
        $this->codigoPais = $codigoPais;
    }
    
    public function getDescricaoPais()
    {
        return $this->descricaoPais;
    }

    public function setDescricaoPais($descricaoPais)
    {
        $this->descricaoPais = $descricaoPais;
    }

    public function getCodigoCidade()
    {
        return $this->codigoCidade;
    }

    public function setCodigoCidade($codigoCidade)
    {
        $codigoCidadeNumbers = preg_replace('/[^0-9]/', '', $codigoCidade);
        if (strlen($codigoCidadeNumbers) !== 7) {
            throw new ValidationError(
                'Código da cidade inválido, por favor verifique se foram informados 7 números.'
            );
        }

        $this->codigoCidade = $codigoCidadeNumbers;

    }

    public function getDescricaoCidade()
    {
        return $this->descricaoCidade;
    }

    public function setDescricaoCidade($descricaoCidade)
    {
        $this->descricaoCidade = $descricaoCidade;
    }

    public function getEstado()
    {
        return $this->estado;
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

    public function getCep()
    {
        return $this->cep;
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
}
