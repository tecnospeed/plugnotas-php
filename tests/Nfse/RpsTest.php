<?php

namespace TecnoSpeed\Plugnotas\Tests\Nfse;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Nfse\Rps;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class RpsTest extends TestCase
{
    /**
     * @covers TecnoSpeed\Plugnotas\Nfse\Rps::setCompetencia
     */
    public function testWithInvalidCompetencia()
    {
        $this->expectException(\TypeError::class);
        $rps = new Rps();
        $rps->setCompetencia('teste');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Nfse\Rps::setDataEmissao
     */
    public function testWithInvalidDataEmissao()
    {
        $this->expectException(\TypeError::class);
        $rps = new Rps();
        $rps->setDataEmissao('teste');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Nfse\Rps::setDataEmissao
     * @covers TecnoSpeed\Plugnotas\Nfse\Rps::setCompetencia
     * @covers TecnoSpeed\Plugnotas\Nfse\Rps::getDataEmissao
     * @covers TecnoSpeed\Plugnotas\Nfse\Rps::getCompetencia
     */
    public function testWithValidRpsData()
    {
        $dateBase = new \DateTime('now');
        $competencia = $dateBase->format('Y-m-d');
        $dataEmissao = $dateBase->format('Y-m-d\TH:i:s');
        $rps = new Rps();
        $rps->setDataEmissao($dateBase);
        $rps->setCompetencia($dateBase);

        $this->assertSame($rps->getDataEmissao(), $dataEmissao);
        $this->assertSame($rps->getCompetencia(), $competencia);
    }
}
