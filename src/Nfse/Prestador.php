<?php

namespace TecnoSpeed\Plugnotas\Nfse;

use FerFabricio\Hydratator\Hydratate;
use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Common\Endereco;
use TecnoSpeed\Plugnotas\Common\Telefone;
use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Error\InvalidTypeError;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class Prestador extends BuilderAbstract
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
        $certificadoId = preg_replace('/[^0-9a-f]/', '', strtolower((string)$certificado));
        if (strlen($certificadoId) !== 24) {
            throw new ValidationError(
                'ID de certificado Inválido.'
            );
        }

        $this->certificado = $certificadoId;
    }

    public function getCertificado()
    {
        return $this->certificado;
    }

    public function setCpfCnpj($cpfCnpj)
    {
        $cleanCpfCnpj = preg_replace('/[^0-9]/', '', $cpfCnpj);

        if (!(strlen($cleanCpfCnpj) === 11 || strlen($cleanCpfCnpj) === 14)) {
            throw new ValidationError(
                'Campo cpfCnpj deve ter 11 ou 14 números.'
            );
        }

        if (strlen($cleanCpfCnpj) === 11) {
            if (!v::cpf()->validate($cleanCpfCnpj)) {
                throw new ValidationError(
                    'CPF inválido.'
                );
            }
        }

        if (strlen($cleanCpfCnpj) === 14) {
            if (!v::cnpj()->validate($cleanCpfCnpj)) {
                throw new ValidationError(
                    'CNPJ inválido.'
                );
            }
        }
        $this->cpfCnpj = $cleanCpfCnpj;
    }

    public function getCpfCnpj()
    {
        return $this->cpfCnpj;
    }

    public function setEmail($email)
    {
        if (!v::email()->validate($email)) {
            throw new ValidationError(
                'Endereço de email inválido.'
            );
        }
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
        if (is_null($inscricaoMunicipal)) {
            throw new ValidationError(
                'Inscrição municipal é requerida para NFSe.'
            );
        }
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
        if (is_null($razaoSocial)) {
            throw new ValidationError(
                'Razão social é requerida para NFSe.'
            );
        }
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
        if (
            is_null($simplesNacional) ||
            !v::boolVal()->validate($simplesNacional)
        ) {
            throw new ValidationError(
                'Optante do Simples nacional é requerida para NFSe.'
            );
        }
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

    public function getTelefone()
    {
        return $this->telefone;
    }

    public static function fromArray($data)
    {
        if (!is_array($data)) {
            throw new InvalidTypeError('Deve ser informado um array.');
        }

        if (array_key_exists('telefone', $data)) {
            $data['telefone'] = Telefone::fromArray($data['telefone']);
        }

        if (array_key_exists('endereco', $data)) {
            $data['endereco'] = Endereco::fromArray($data['endereco']);
        }

        return Hydratate::toObject(self::class, $data);
    }
}
