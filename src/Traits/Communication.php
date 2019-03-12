<?php

namespace TecnoSpeed\Plugnotas\Traits;

use TecnoSpeed\Plugnotas\Communication\CallApi;

trait Communication
{
    /**
     * @codeCoverageIgnore
     */
    protected function getCallApiInstance($configuration)
    {
        return new CallApi($configuration);
    }
}

