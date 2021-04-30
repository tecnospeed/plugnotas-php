<?php

namespace TecnoSpeed\Plugnotas\Nfse;

use FerFabricio\Hydrator\Hydrate;
use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Configuration;
use TecnoSpeed\Plugnotas\Communication\CallApi;
use TecnoSpeed\Plugnotas\Common\Endereco;
use TecnoSpeed\Plugnotas\Common\Telefone;
use TecnoSpeed\Plugnotas\Error\InvalidTypeError;
use TecnoSpeed\Plugnotas\Error\RequiredError;
use TecnoSpeed\Plugnotas\Error\ValidationError;
use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Traits\Communication;

class Tomador extends BuilderAbstract
{
    use Communication;

    private $cpfCnpj;
    private $inscricaoMunicipal;
    private $email;
    private $endereco;
    private $inscricaoEstadual;
    private $inscricaoSuframa;
    private $indicadorInscricaoEstadual;
    private $nomeFantasia;
    private $razaoSocial;
    private $telefone;
    private $orgaoPublico;

    public function setCpfCnpj($cpfCnpj)
    {
        $cleanCpfCnpj = preg_replace('/[^0-9]/', '', $cpfCnpj);

        if (
            !is_null($cpfCnpj) &&
            !((strlen($cleanCpfCnpj) === 11 || strlen($cleanCpfCnpj) === 14))
            ) {
            throw new ValidationError(
                'Quando preenchido, o campo cpfCnpj deve possuir 11 ou 14 números.'
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

    public function setInscricaoMunicipal($inscricaoMunicipal){
        $this->inscricaoMunicipal = $inscricaoMunicipal;
    }
    public function getInscricaoMunicipal()
    {
        return $this->inscricaoMunicipal;
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

    public function setInscricaoEstadual($inscricaoEstadual)
    {
        $this->inscricaoEstadual = $inscricaoEstadual;
    }

    public function getInscricaoEstadual()
    {
        return $this->inscricaoEstadual;
    }

    public function setInscricaoSuframa($inscricaoSuframa)
    {
        $this->inscricaoSuframa = $inscricaoSuframa;
    }

    public function getInscricaoSuframa()
    {
        return $this->inscricaoSuframa;
    }
    
    public function setIndicadorInscricaoEstadual($indicadorInscricaoEstadual)
    {
        if (!v::in([1,2,9])->validate($indicadorInscricaoEstadual)) {
            throw new ValidationError(
                'Tipo indicador Inscricão Estadual inválido.'
            );
        }
        $this->indicadorInscricaoEstadual = $indicadorInscricaoEstadual;
    }

    public function getIndicadorInscricaoEstadual()
    {
        return $this->indicadorInscricaoEstadual;
    }

    public function setNomeFantasia($nomeFantasia)
    {
        $this->nomeFantasia = $nomeFantasia;
    }

    public function getNomeFantasia()
    {
        return $this->nomeFantasia;
    }
    public function setOrgaoPublico($orgaoPublico)
    {
        $this->orgaoPublico = $orgaoPublico;
    }

    public function getOrgaoPublico()
    {
        return $this->orgaoPublico;
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

    public function setTelefone(Telefone $telefone)
    {
        $this->telefone = $telefone;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function validate()
    {
        $data = $this->toArray(true);
        if(
            !v::allOf(
                v::keyNested('cpfCnpj'),
                v::keyNested('razaoSocial')
            )->validate($data)
        ) {
            throw new RequiredError(
                'Os parâmetros mínimos para criar um Tomador não foram preenchidos.'
            );
        }

        return true;
    }

    public function send(Configuration $configuration)
    {
        $this->validate();

        $communication = $this->getCallApiInstance($configuration);
        return $communication->send('POST', '/nfse/tomador', $this->toArray(true));
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

        return Hydrate::toObject(self::class, $data);
    }
}
