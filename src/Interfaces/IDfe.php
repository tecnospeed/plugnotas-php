<?php

namespace TecnoSpeed\Plugnotas\Interfaces;

use TecnoSpeed\Plugnotas\Configuration;

interface IDfe
{
    public function send(Configuration $configuration);
    public function toArray();
    public function validate();
    public static function fromArray($items);
}
