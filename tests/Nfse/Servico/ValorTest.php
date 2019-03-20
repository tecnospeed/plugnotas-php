<?php

namespace TecnoSpeed\Plugnotas\Tests\Nfse\Servico;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Error\ValidationError;
use TecnoSpeed\Plugnotas\Nfse\Servico\Valor;

class ValorTest extends TestCase
{

    public function testBaseCalculoWithInvalidValue()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Base de cálculo deve ser um valor numérico.');
        $valor = new Valor();
        $valor->setBaseCalculo('teste');
    }

    public function testDeducoesWithInvalidValue()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Deduções deve ser um valor numérico.');
        $valor = new Valor();
        $valor->setDeducoes('teste');
    }

    public function testDescontoCondicionadoWithInvalidValue()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Desconto condicional deve ser um valor numérico.');
        $valor = new Valor();
        $valor->setDescontoCondicionado('teste');
    }

    public function testDescontoIncondicionadoWithInvalidValue()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Desconto incondicional deve ser um valor numérico.');
        $valor = new Valor();
        $valor->setDescontoIncondicionado('teste');
    }

    public function testLiquidoWithInvalidValue()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Valor líquido deve ser um valor numérico.');
        $valor = new Valor();
        $valor->setLiquido('teste');
    }

    public function testServicoWithInvalidValue()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('O valor do serviço deve ser um valor numérico.');
        $valor = new Valor();
        $valor->setServico('teste');
    }

    public function testTypeConversion()
    {
        $valor = new Valor();
        $valor->setBaseCalculo('0.01');
        $valor->setDeducoes('0.02');
        $valor->setDescontoCondicionado('0.03');
        $valor->setDescontoIncondicionado('0.04');
        $valor->setLiquido('0.05');
        $valor->setServico('0.06');

        $this->assertInternalType('double', $valor->getBaseCalculo());
        $this->assertInternalType('double', $valor->getDeducoes());
        $this->assertInternalType('double', $valor->getDescontoCondicionado());
        $this->assertInternalType('double', $valor->getDescontoIncondicionado());
        $this->assertInternalType('double', $valor->getLiquido());
        $this->assertInternalType('double', $valor->getServico());
    }

    public function testWithValidData()
    {
        $valor = new Valor();
        $valor->setBaseCalculo(0.01);
        $valor->setDeducoes(0.02);
        $valor->setDescontoCondicionado(0.03);
        $valor->setDescontoIncondicionado(0.04);
        $valor->setLiquido(0.05);
        $valor->setServico(0.06);

        $this->assertSame($valor->getBaseCalculo(), 0.01);
        $this->assertSame($valor->getDeducoes(), 0.02);
        $this->assertSame($valor->getDescontoCondicionado(), 0.03);
        $this->assertSame($valor->getDescontoIncondicionado(), 0.04);
        $this->assertSame($valor->getLiquido(), 0.05);
        $this->assertSame($valor->getServico(), 0.06);
    }
}

