<?php

namespace TecnoSpeed\Plugnotas\Tests\Common;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Common\ValorAliquota;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class ValorAliquotaTest extends TestCase
{

    public function testValorWithInvalidData()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Valor deve ser um número.');
        $valorAliquota = new ValorAliquota();
        $valorAliquota->setValor('teste');
    }

    public function testAliquotaWithInvalidData()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Aliquota deve ser um número.');
        $valorAliquota = new ValorAliquota();
        $valorAliquota->setAliquota('teste');
    }

    public function testWithValidData()
    {
        $valorAliquota = new ValorAliquota(100.12, 1.01);
        $this->assertSame($valorAliquota->getValor(), 100.12);
        $this->assertSame($valorAliquota->getAliquota(), 1.01);
    }
}
