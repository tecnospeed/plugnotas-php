<?php

namespace TecnoSpeed\Plugnotas\Abstracts;

use FerFabricio\Hydratate\Hydratate;
use TecnoSpeed\Plugnotas\Interfaces\IBuilder;

class BuilderAbstract implements IBuilder
{
    public static function fromArray($items)
    {
        if (is_array($items)) {
            return Hydratate::toObject(self::class, $items);
        }

        throw new InvalidTypeError('Deve ser informado um array');
    }
}
