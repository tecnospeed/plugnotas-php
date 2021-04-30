<?php
namespace TecnoSpeed\Plugnotas\Nfse;

use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class Intermediario extends BuilderAbstract
{
    private $tipo;
    private $cpfCnpj;
    private $razaoSocial;
    private $inscricaoMunicipal;


    public function setTipo($tipo)
    {
        if (!v::in([0,1])->validate($tipo)) {
            throw new ValidationError(
                'Tipo inválido.'
            );
        }
        $this->tipo = $tipo;
    }

    public function getTipo()
    {
        return $this->tipo;
    }


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


    public function setRazaoSocial($razaoSocial)
    {
        $this->razaoSocial = $razaoSocial;
    }

    public function getRazaoSocial()
    {
        return $this->razaoSocial;
    }


    public function setInscricaoMunicipal($inscricaoMunicipal)
    {
        $this->inscricaoMunicipal = $inscricaoMunicipal;
    }

    public function getInscricaoMunicipal()
    {
        return $this->inscricaoMunicipal;
    }

}
?>