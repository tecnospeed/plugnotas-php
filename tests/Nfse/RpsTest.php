<?php

namespace TecnoSpeed\Plugnotas\Tests\Nfse;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Nfse\Rps;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class RpsTest extends TestCase
{
    public function testWithInvalidCompetencia()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('competencia deve ser uma data válida.');
        $rps = new Rps();
        $rps->setCompetencia('teste');
    }

    public function testWithInvalidDataEmissao()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('dataEmissao deve ser uma data válida.');
        $rps = new Rps();
        $rps->setDataEmissao('teste');
    }

    public function testWithValidRpsData()
    {
        $dateCompare = new \DateTime('now');
        $rps = new Rps();
        $rps->setDataEmissao($dateCompare);
        $rps->setCompetencia($dateCompare);

        $this->assertSame($rps->getDataEmissao()->format('Y-m-d h:i:s'), $dateCompare->format('Y-m-d h:i:s'));
        $this->assertSame($rps->getCompetencia()->format('Y-m-d h:i:s'), $dateCompare->format('Y-m-d h:i:s'));
    }
}
