<?php

namespace TecnoSpeed\Plugnotas\Interfaces;

use TecnoSpeed\Plugnotas\Configuration;

interface ILogotipo
{
    public function create($cnpj, Configuration $configuration);
}
