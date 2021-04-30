<?php

namespace TecnoSpeed\Plugnotas\Nfse;

use FerFabricio\Hydrator\Hydrate;
use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Common\Endereco;
use TecnoSpeed\Plugnotas\Common\Telefone;
use TecnoSpeed\Plugnotas\Communication\CallApi;
use TecnoSpeed\Plugnotas\Configuration;
use TecnoSpeed\Plugnotas\Error\InvalidTypeError;
use TecnoSpeed\Plugnotas\Error\RequiredError;
use TecnoSpeed\Plugnotas\Error\ValidationError;
use TecnoSpeed\Plugnotas\Traits\Communication;
use TecnoSpeed\Plugnotas\Common\Nfse;

class Prestador extends BuilderAbstract
{
    use Communication;

    private $certificado;
    private $cpfCnpj;
    private $email;
    private $endereco;
    private $incentivadorCultural;
    private $incentivoFiscal;
    private $inscricaoMunicipal;
    private $inscricaoEstadual;
    private $nomeFantasia;
    private $razaoSocial;
    private $regimeTributario;
    private $regimeTributarioEspecial;
    private $simplesNacional;
    private $telefone;
    private $nfse;


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

    public function setNfse(Nfse $nfse)
    {
        $this->nfse = $nfse;
    }

    public function getNfse()
    {
        return $this->nfse;
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

    public function setInscricaoEstadual($inscricaoEstadual)
    {
        $this->inscricaoEstadual = $inscricaoEstadual;
    }

    public function getInscricaoEstadual()
    {
        return $this->inscricaoEstadual;
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

        if (array_key_exists('nfse', $data)) {
            $data['nfse'] = Nfse::fromArray($data['nfse']);
        }    

        return Hydrate::toObject(self::class, $data);
    }

    public function validate()
    {
        $data = $this->toArray();
        if(
            !v::allOf(
                v::keyNested('cpfCnpj'),
                v::keyNested('razaoSocial'),
                v::keyNested('simplesNacional'),
                v::keyNested('endereco.logradouro'),
                v::keyNested('endereco.numero'),
                v::keyNested('endereco.codigoCidade'),
                v::keyNested('endereco.cep')
            )->validate($data)
        ) {
            throw new RequiredError(
                'Os parâmetros mínimos para criar um Prestador não foram preenchidos.'
            );
        }

        return true;
    }

    public function send(Configuration $configuration)
    {
        $this->validate();

        $communication = $this->getCallApiInstance($configuration);
        return $communication->send('POST', '/empresa', $this->toArray(true));
    }
}
