<?php

namespace TecnoSpeed\Plugnotas\Tests\Nfse\Servico;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Common\ValorAliquota;
use TecnoSpeed\Plugnotas\Nfse\Servico\Retencao;

class RetencaoTest extends TestCase
{
    public function testWithValidData()
    {
        $retencao = new Retencao();
        $retencao->setCofins(new ValorAliquota(100.10, 1.01));
        $retencao->setCsll(new ValorAliquota(202.20, 2.02));
        $retencao->setInss(new ValorAliquota(303.30, 3.03));
        $retencao->setIrrf(new ValorAliquota(404.40, 4.04));
        $retencao->setOutrasRetencoes(new ValorAliquota(505.50, 5.05));
        $retencao->setPis(new ValorAliquota(606.60, 6.06));

        $this->assertSame($retencao->getCofins()->getAliquota(), 1.01);
        $this->assertSame($retencao->getCofins()->getValor(), 100.10);
        $this->assertSame($retencao->getCsll()->getAliquota(), 2.02);
        $this->assertSame($retencao->getCsll()->getValor(), 202.20);
        $this->assertSame($retencao->getInss()->getAliquota(), 3.03);
        $this->assertSame($retencao->getInss()->getValor(), 303.30);
        $this->assertSame($retencao->getIrrf()->getAliquota(), 4.04);
        $this->assertSame($retencao->getIrrf()->getValor(), 404.40);
        $this->assertSame($retencao->getOutrasRetencoes()->getAliquota(), 5.05);
        $this->assertSame($retencao->getOutrasRetencoes()->getValor(), 505.50);
        $this->assertSame($retencao->getPis()->getAliquota(), 6.06);
        $this->assertSame($retencao->getPis()->getValor(), 606.60);

    }
}
