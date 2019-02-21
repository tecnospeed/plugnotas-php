<?php

namespace TecnoSpeed\Plugnotas\Interfaces;

interface IDfe
{
    public function validate();
    public function toArray();
    public static function fromArray($items);
}
