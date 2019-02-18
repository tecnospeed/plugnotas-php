<?php

namespace TecnoSpeed\Plugnotas\Nfse;

use TecnoSpeed\Plugnotas\Common\Endereco;
use TecnoSpeed\Plugnotas\Common\Telefone;

class Prestador
{
    private $certificado;
    private $cpfCnpj;
    private $email;
    private $endereco;
    private $incentivadorCultural;
    private $incentivoFiscal;
    private $inscricaoMunicipal;
    private $nomeFantasia;
    private $razaoSocial;
    private $regimeTributario;
    private $regimeTributarioEspecial;
    private $simplesNacional;
    private $telefone;

    public function setCertificado($certificado)
    {
        $this->certificado = $certificado;
    }

    public function getCertificado()
    {
        return $this->certificado;
    }

    public function setCpfCnpj($cpfCnpj)
    {
        $this->cpfCnpj = $cpfCnpj;
    }

    public function getCpfCnpj()
    {
        return $this->cpfCnpj;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEndereco(Endereco $endereco)
    {
        $this->endereco = $endereco;
    }

    public function setEndereco(Endereco $endereco)
    {
        $this->endereco = $endereco;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setIncentivadorCultural($incentivadorCultural)
    {
        $this->incentivadorCultural = $incentivadorCultural;
    }

    public function getIncentivadorCultural()
    {
        return $this->incentivadorCultural;
    }

    public function setIncentivoFiscal($incentivoFiscal)
    {
        $this->incentivoFiscal = $incentivoFiscal;
    }

    public function getIncentivoFiscal()
    {
        return $this->incentivoFiscal;
    }

    public function setInscricaoMunicipal($inscricaoMunicipal)
    {
        $this->inscricaoMunicipal = $inscricaoMunicipal;
    }

    public function getInscricaoMunicipal()
    {
        return $this->inscricaoMunicipal;
    }

    public function setNomeFantasia($nomeFantasia)
    {
        $this->nomeFantasia = $nomeFantasia;
    }

    public function getNomeFantasia()
    {
        return $this->nomeFantasia;
    }

    public function setRazaoSocial($razaoSocial)
    {
        $this->razaoSocial = $razaoSocial;
    }

    public function getRazaoSocial()
    {
        return $this->razaoSocial;
    }

    public function setRegimeTributario($regimeTributario)
    {
        $this->regimeTributario = $regimeTributario;
    }

    public function getRegimeTributario()
    {
        return $this->regimeTributario;
    }

    public function setRegimeTributarioEspecial($regimeTributarioEspecial)
    {
        $this->regimeTributarioEspecial = $regimeTributarioEspecial;
    }

    public function getRegimeTributarioEspecial()
    {
        return $this->regimeTributarioEspecial;
    }

    public function setSimplesNacional($simplesNacional)
    {
        $this->simplesNacional = $simplesNacional;
    }

    public function getSimplesNacional()
    {
        return $this->simplesNacional;
    }

    public function setTelefone(Telefone $telefone)
    {
        $this->telefone = $telefone;
    }

    public function setTelefone($ddd, $numero)
    {
        $telefone = new Telefone($ddd, $numero);
        $this->telefone = $telefone;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

}
