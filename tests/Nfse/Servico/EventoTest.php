<?php

namespace TecnoSpeed\Plugnotas\Tests\Nfse\Servico;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Nfse\Servico\Evento;

class EventoTest extends TestCase
{
    public function testWithValidData()
    {
        $evento = new Evento();
        $evento->setCodigo('4051200');
        $evento->setDescricao('CONFERENCIA');

        $this->assertSame($evento->getCodigo(), '4051200');
        $this->assertSame($evento->getDescricao(), 'CONFERENCIA');
    }
}
