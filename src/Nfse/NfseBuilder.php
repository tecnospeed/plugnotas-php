<?php

namespace TecnoSpeed\Plugnotas\Nfse;

use TecnoSpeed\Plugnotas\Nfse;
use TecnoSpeed\Plugnotas\Nfse\Prestador;
use TecnoSpeed\Plugnotas\Nfse\Rps;
use TecnoSpeed\Plugnotas\Nfse\Servico;
use TecnoSpeed\Plugnotas\Nfse\Tomador;
use TecnoSpeed\Plugnotas\Error\InvalidTypeError;

class NfseBuilder
{
    private $rps;
    private $tomador;
    private $prestador;
    private $servico;

    private function callFromArray($name, $class, $data)
    {
        if (is_array($data)) {
            $this->{$name} = $class::fromArray($data);
            return $this;
        }

        if (get_class($data) === $class) {
            $this->{$name} = $data;
            return $this;
        }

        throw new InvalidTypeError(
            'Deve ser informado um array ou um objeto do tipo: ' . $class
        );
    }

    public function withTomador($tomador)
    {
        return $this->callFromArray('tomador', Tomador::class, $data);
    }

    public function withPrestador($data)
    {
        return $this->callFromArray('prestador', Prestador::class, $data);
    }

    public function withServico($data)
    {
        return $this->callFromArray('servico', Servico::class, $data);
    }

    public function withRps($data)
    {
        return $this->callFromArray('servico', Servico::class, $data);
    }

    public function build($data)
    {
        $nfse = Nfse::fromArray($data);

        if (!is_null($this->prestador)) {
            $nfse->setPrestador($this->prestador);
        }

        if (!is_null($this->tomador)) {
            $nfse->setTomador($this->tomador);
        }

        if (!is_null($this->rps)) {
            $nfse->setRps($this->rps);
        }

        if (!is_null($this->servico)) {
            $nfse->setServico($this->servico);
        }

        return $nfse;
    }
}
