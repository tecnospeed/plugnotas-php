<?php

namespace TecnoSpeed\Plugnotas\Tests\Nfse;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Error\ValidationError;
use TecnoSpeed\Plugnotas\Nfse\Impressao;

class ImpressaoTest extends TestCase
{
    public function testWithInvalidData()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('camposCustomizados deve ser um array.');
        $impressao = new Impressao();
        $impressao->setCamposCustomizados('teste');
    }

    public function testWithValidData()
    {
        $impressao = new Impressao();
        $impressao->setCamposCustomizados(['teste' => 'teste']);
        $this->assertSame($impressao->getCamposCustomizados()['teste'], 'teste');
    }
}
