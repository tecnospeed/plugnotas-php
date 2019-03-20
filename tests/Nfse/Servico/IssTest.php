<?php

namespace TecnoSpeed\Plugnotas\Tests\Nfse\Servico;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Nfse\Servico\Iss;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class IssTest extends TestCase
{
    public function testInvalidAliquota()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('É necessário informar um valor numérico para aliquota.');
        $iss = new Iss();
        $iss->setAliquota('teste');
    }

    public function testInvalidExigibilidade()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Exigibilidade inválida.');
        $iss = new Iss();
        $iss->setExigibilidade(0);
    }

    public function testInvalidRetencao()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Retido deve ser um valor booleano.');
        $iss = new Iss();
        $iss->setRetido('teste');
    }

    public function testInvalidTipoTributacao()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Tipo de tributação inválido.');
        $iss = new Iss();
        $iss->setTipoTributacao(0);
    }

    public function testInvalidValor()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('É necessário informar um valor numérico para o campo valor.');
        $iss = new Iss();
        $iss->setValor('teste');
    }

    public function testInvalidValorRetido()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('É necessário informar um valor numérico para o campo valorRetido.');
        $iss = new Iss();
        $iss->setValorRetido('teste');
    }

    public function testTypeConversion()
    {
        $iss = new Iss();
        $iss->setAliquota('0.03');
        $iss->setRetido('');
        $iss->setValor('0.01');
        $iss->setValorRetido('0.01');
        $this->assertInternalType('double', $iss->getAliquota());
        $this->assertInternalType('double', $iss->getAliquota());
        $this->assertInternalType('bool', $iss->getRetido());
        $this->assertFalse($iss->getRetido());
        $this->assertInternalType('double', $iss->getValor());
        $this->assertInternalType('double', $iss->getValorRetido());
    }

    public function testValidCreation()
    {
        $iss = new Iss();
        $iss->setAliquota(0.03);
        $iss->setExigibilidade(1);
        $iss->setProcessoSuspensao('1234');
        $iss->setRetido(true);
        $iss->setTipoTributacao(1);
        $iss->setValor(12.30);
        $iss->setValorRetido(1.23);

        $this->assertSame($iss->getAliquota(), 0.03);
        $this->assertSame($iss->getExigibilidade(), 1);
        $this->assertSame($iss->getProcessoSuspensao(), '1234');
        $this->assertSame($iss->getRetido(), true);
        $this->assertSame($iss->getTipoTributacao(), 1);
        $this->assertSame($iss->getValor(), 12.30);
        $this->assertSame($iss->getValorRetido(), 1.23);
    }
}
