<?php

namespace TecnoSpeed\Plugnotas\Tests\Nfse\Servico;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Nfse\Servico\Deducao;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class DeducaoTest extends TestCase
{
    public function testInvalidTipo()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Tipo inválido.');
        $deducao = new Deducao();
        $deducao->setTipo(100);
    }

    public function testDeducaoWithValidData()
    {
        $deducao = new Deducao();
        $deducao->setTipo(99);
        $deducao->setDescricao('Teste de deducao');

        $this->assertSame($deducao->getTipo(), 99);
        $this->assertSame($deducao->getDescricao(), 'Teste de deducao');
    }
}
