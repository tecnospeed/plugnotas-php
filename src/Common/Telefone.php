<?php

namespace TecnoSpeed\Plugnotas\Common;

use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class Telefone extends BuilderAbstract
{
    private $ddd;
    private $numero;

    public function __construct($ddd = null, $numero = null)
    {
        if (!is_null($ddd)) {
            $this->setDdd($ddd);
        }

        if (!is_null($numero)) {
            $this->setNumero($numero);
        }
    }

    public function getDdd()
    {
        return $this->ddd;
    }

    public function setDdd($ddd)
    {
        $dddNumbers = preg_replace('/[^0-9]/', '', (string)$ddd);
        if (strlen($dddNumbers) > 0 && $dddNumbers[0] === '0') {
            $dddNumbers = substr($dddNumbers, 1, 2);
        }

        if (strlen($dddNumbers) !== 2) {
            throw new ValidationError(
                'DDD inválido.'
            );
        }

        $this->ddd = $dddNumbers;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        $numberClear = preg_replace('/[^0-9]/', '', (string)$numero);
        if (strlen($numberClear) > 0 && $numberClear[0] === '0') {
            $numberClear = substr($numberClear, 1, strlen($numberClear));
        }

        if (strlen($numberClear) !== 8 && strlen($numberClear) !== 9) {
            throw new ValidationError(
                'Número inválido.'
            );
        }

        $this->numero = $numberClear;
    }
}
