<?php

namespace TecnoSpeed\Plugnotas\Common;

use FerFabricio\Hydrator\Hydrate;
use Respect\Validation\Validator as v;

use TecnoSpeed\Plugnotas\Error\ValidationError;
use TecnoSpeed\Plugnotas\Error\InvalidTypeError;
use TecnoSpeed\Plugnotas\Common\ConfigNfse\Config;
use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;

class Nfse extends BuilderAbstract
{
    private $ativo;
    private $tipoContrato;
    private $config;

    public static function fromArray($data)
    {
        if (!is_array($data)) {
            throw new InvalidTypeError('Deve ser informado um array.');
        }

        if (array_key_exists('config', $data)) {
            $data['config'] = Config::fromArray($data['config']);
        }

        return Hydrate::toObject(self::class, $data);
    }

    public function setAtivo($ativo)
    {
        if (
            is_null($ativo) ||
            !v::boolVal()->validate($ativo)
        ) {
            throw new ValidationError(
                'Ativo é requerido para o cadastro de NFS-e.'
            );
        }

        $this->ativo = $ativo;
    }

    public function getAtivo()
    {
        return $this->ativo;
    }

    public function setTipoContrato($tipoContrato)
    {
        if (
            !is_null($tipoContrato) &&
            !($tipoContrato === 0 ||
            $tipoContrato === 1)
        ){
            throw new ValidationError(
                'Valor inválido para o TipoContrato. Valores aceitos: null, 0, 1'
            );
        }

        $this->tipoContrato = $tipoContrato;
    }

    public function getTipoContrato()
    {
        return $this->tipoContrato;
    }

    public function setConfig(Config $config)
    {
        $this->config = $config;
    }

    public function getConfig()
    {
        return $this->config;
    }
}
