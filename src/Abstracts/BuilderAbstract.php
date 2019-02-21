<?php

namespace TecnoSpeed\Plugnotas\Abstracts;

use FerFabricio\Hydratator\Hydratate;
use TecnoSpeed\Plugnotas\Error\InvalidTypeError;
use TecnoSpeed\Plugnotas\Interfaces\IBuilder;

class BuilderAbstract implements IBuilder
{
    public static function fromArray($data)
    {
        if (is_array($data)) {
            return Hydratate::toObject(\get_called_class(), $data);
        }

        if (is_object($data) && get_class($data) === \get_called_class()) {
            return $data;
        }

        throw new InvalidTypeError('Deve ser informado um array.');
    }
}
