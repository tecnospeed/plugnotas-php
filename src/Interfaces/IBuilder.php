<?php

namespace TecnoSpeed\Plugnotas\Interfaces;

interface IBuilder
{
    public function toArray();
    public static function fromArray($items);
}
