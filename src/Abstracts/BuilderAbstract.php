<?php

namespace TecnoSpeed\Plugnotas\Abstracts;

use FerFabricio\Hydrator\Extract;
use FerFabricio\Hydrator\Hydrate;
use TecnoSpeed\Plugnotas\Error\InvalidTypeError;
use TecnoSpeed\Plugnotas\Interfaces\IBuilder;

abstract class BuilderAbstract implements IBuilder
{
    public function toArray($excludeNull = true)
    {
        return Extract::toArray($this, $excludeNull);
    }

    public static function fromArray($data)
    {
        if (is_array($data)) {
            return Hydrate::toObject(\get_called_class(), $data);
        }

        if (is_object($data) && get_class($data) === \get_called_class()) {
            return $data;
        }

        throw new InvalidTypeError('Deve ser informado um array.');
    }
}
