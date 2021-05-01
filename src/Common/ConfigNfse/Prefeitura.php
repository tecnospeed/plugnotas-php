<?php

namespace TecnoSpeed\Plugnotas\Common\ConfigNfse;

use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Error\ValidationError;
use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;

class Prefeitura extends BuilderAbstract
{
    private $login;
    private $senha;
    private $receitaBruta;
    private $lei;
    private $dataInicio;

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setReceitaBruta($receitaBruta)
    {
        $this->receitaBruta = $receitaBruta;
    }

    public function getReceitaBruta()
    {
        return $this->receitaBruta;
    }

    public function setLei($lei)
    {
        $this->lei = $lei;
    }

    public function getLei()
    {
        return $this->lei;
    }

    public function setDataInicio($dataInicio)
    {
        if(
            !is_null($dataInicio) &&
            !v::date('Y-m-d')->validate($dataInicio)
        ) {
            throw new ValidationError(
                'Formato da data é inválido. Formato válido YYYY-MM-DD.'
            );
        }
        $this->dataInicio = $dataInicio;
    }

    public function getDataInicio()
    {
        return $this->dataInicio;
    }
}
