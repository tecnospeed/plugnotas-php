<?php

namespace TecnoSpeed\Plugnotas\Abstracts;

use FerFabricio\Hydratator\Extract;
use FerFabricio\Hydratator\Hydratate;
use TecnoSpeed\Plugnotas\Error\InvalidTypeError;
use TecnoSpeed\Plugnotas\Interfaces\IBuilder;

abstract class BuilderAbstract implements IBuilder
{
    public function toArray($excludeNull = false)
    {
        return Extract::toArray($this, $excludeNull);
    }

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
