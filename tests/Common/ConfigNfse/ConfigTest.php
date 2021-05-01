<?php

namespace TecnoSpeed\Plugnotas\Tests\Common\ConfigNfse;

use PHPUnit\Framework\TestCase;

use TecnoSpeed\Plugnotas\Error\ValidationError;
use TecnoSpeed\Plugnotas\Error\InvalidTypeError;

use TecnoSpeed\Plugnotas\Common\ConfigNfse\Rps;
use TecnoSpeed\Plugnotas\Common\ConfigNfse\Config;
use TecnoSpeed\Plugnotas\Common\ConfigNfse\Prefeitura;

class ConfigTest extends TestCase
{
    /**
     * @covers TecnoSpeed\Plugnotas\Common\ConfigNfse\Config::setProducao
     */
    public function testInvalidProducao()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Producao tem que ser um valor booleano');
        $config = new Config();
        $config->setProducao('teste');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\ConfigNfse\Config::fromArray
     */
    public function testWithInvalidArray()
    {
        $this->expectException(InvalidTypeError::class);
        $this->expectExceptionMessage('Deve ser informado um array.');
        Config::fromArray('invalid-array');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\ConfigNfse\Config::fromArray
     */
    public function testWithValidArray()
    {
        $config = Config::fromArray([
            'producao' => true,
            'rps' => [],
            'prefeitura' => []
        ]);

        $this->assertSame($config->getProducao(), true);
        $this->assertEquals($config->getRps(), new Rps([]));
        $this->assertEquals($config->getPrefeitura(), new Prefeitura([]));
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\ConfigNfse\Config::setRps
     * @covers TecnoSpeed\Plugnotas\Common\ConfigNfse\Config::setPrefeitura
     * @covers TecnoSpeed\Plugnotas\Common\ConfigNfse\Config::setProducao
     */
    public function testWithValidData()
    {
        $config = new Config();
        $config->setRps(new Rps([]));
        $config->setPrefeitura(new Prefeitura([]));
        $config->setProducao(true);

        $this->assertSame($config->getProducao(), true);
        $this->assertEquals($config->getRps(), new Rps([]));
        $this->assertEquals($config->getPrefeitura(), new Prefeitura([]));
    }
}
