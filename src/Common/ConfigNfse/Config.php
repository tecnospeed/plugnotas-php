<?php

namespace TecnoSpeed\Plugnotas\Common\ConfigNfse;

use FerFabricio\Hydrator\Hydrate;
use Respect\Validation\Validator as v;

use TecnoSpeed\Plugnotas\Common\ConfigNfse\Rps;
use TecnoSpeed\Plugnotas\Common\ConfigNfse\Prefeitura;

use TecnoSpeed\Plugnotas\Error\ValidationError;
use TecnoSpeed\Plugnotas\Error\InvalidTypeError;
use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;

class Config extends BuilderAbstract
{
    private $producao;
    private $rps;
    private $prefeitura;

    public static function fromArray($data)
    {
        if (!is_array($data)) {
            throw new InvalidTypeError('Deve ser informado um array.');
        }

        if (array_key_exists('rps', $data)) {
            $data['rps'] = Rps::fromArray($data['rps']);
        }

        if (array_key_exists('prefeitura', $data)) {
            $data['prefeitura'] = Prefeitura::fromArray($data['prefeitura']);
        }

        return Hydrate::toObject(self::class, $data);
    }

    public function setPrefeitura(Prefeitura $prefeitura)
    {
        $this->prefeitura = $prefeitura;
    }

    public function getPrefeitura()
    {
        return $this->prefeitura;
    }

    public function setRps(Rps $rps)
    {
        $this->rps = $rps;
    }

    public function getRps()
    {
        return $this->rps;
    }

    public function setProducao($producao)
    {
        if (
            !v::boolVal()->validate($producao)
        ) {
            throw new ValidationError(
                'Producao tem que ser um valor booleano'
            );
        }

        $this->producao = $producao;
    }

    public function getProducao()
    {
        return $this->producao;
    }
}
