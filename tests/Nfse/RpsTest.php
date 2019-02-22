<?php

namespace TecnoSpeed\Plugnotas\Tests\Nfse;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Nfse\Rps;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class RpsTest extends TestCase
{
    public function testWithInvalidCompetencia()
    {
        $this->expectException(\TypeError::class);
        $rps = new Rps();
        $rps->setCompetencia('teste');
    }

    public function testWithInvalidDataEmissao()
    {
        $this->expectException(\TypeError::class);
        $rps = new Rps();
        $rps->setDataEmissao('teste');
    }

    public function testWithValidRpsData()
    {
        $dateCompare = new \DateTime('now');
        $rps = new Rps();
        $rps->setDataEmissao($dateCompare);
        $rps->setCompetencia($dateCompare);

        $this->assertSame($rps->getDataEmissao(), $dateCompare->format('Y-m-d'));
        $this->assertSame($rps->getCompetencia(), $dateCompare->format('Y-m-d'));
    }
}
