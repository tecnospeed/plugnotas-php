<?php

namespace TecnoSpeed\Plugnotas\Nfse;

use FerFabricio\Hydratate\Hydratate;
use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Common\Endereco;
use TecnoSpeed\Plugnotas\Common\Telefone;
use TecnoSpeed\Plugnotas\Error\InvalidTypeError;
use TecnoSpeed\Plugnotas\Error\ValidationError;
use TecnoSpeed\Plugnotas\Interfaces\IBuilder;


class Tomador implements IBuilder
{
    private $cpfCnpj;
    private $email;
    private $endereco;
    private $inscricaoEstadual;
    private $nomeFantasia;
    private $razaoSocial;
    private $telefone;

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

    public function setTelefone(Telefone $telefone)
    {
        $this->telefone = $telefone;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public static function fromArray($items)
    {
        if (!is_array($items)) {
            throw new InvalidTypeError('Deve ser informado um array');
        }

        if (array_key_exists('telefone', $items)) {
            $items['telefone'] = Telefone::fromArray($items['telefone']);
        }

        if (array_key_exists('endereco', $items)) {
            $items['endereco'] = Endereco::fromArray($items['endereco']);
        }

        return Hydratate::toObject(self::class, $items);
    }
}
