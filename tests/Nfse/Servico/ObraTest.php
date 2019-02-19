<?php

namespace TecnoSpeed\Plugnotas\Tests\Nfse\Servico;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Nfse\Servico\Obra;

class ObraTest extends TestCase
{
    public function testWithValidData()
    {
        $obra = new Obra();
        $obra->setArt('6270201');
        $obra->setCodigo('21');

        $this->assertSame($obra->getArt(), '6270201');
        $this->assertSame($obra->getCodigo(), '21');
    }
}
