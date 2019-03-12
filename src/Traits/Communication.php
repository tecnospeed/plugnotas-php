<?php

namespace TecnoSpeed\Plugnotas\Traits;

use TecnoSpeed\Plugnotas\Communication\CallApi;

trait Communication
{
    protected function getCallApiInstance($configuration)
    {
        return new CallApi($configuration);
    }
}

