<?php
namespace TecnoSpeed\Plugnotas\Tests;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Communication\CallApi;
use TecnoSpeed\Plugnotas\Configuration;
use TecnoSpeed\Plugnotas\Error\ConfigurationRequiredError;
use TecnoSpeed\Plugnotas\Traits\Communication;

class ExampleCase
{
    use Communication;

    public function teste($configuration)
    {
        return $this->getCallApiInstance($configuration);
    }
}

final class CommunicationTest extends TestCase
{
    /**
     * @covers TecnoSpeed\Plugnotas\Traits\Communication::getCallApiInstance
     */
    public function testWithoutCommunication()
    {
        $this->expectException(ConfigurationRequiredError::class);
        $this->expectExceptionMessage('É necessário setar a configuração utilizando o método setConfiguration.');
        $test = new ExampleCase();
        $test->teste(null);
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Traits\Communication::getCallApiInstance
     */
    public function testSuccessFull()
    {
        $configuration = new Configuration(
            Configuration::TYPE_ENVIRONMENT_SANDBOX,
            '2da392a6-79d2-4304-a8b7-959572c7e44d'
        );

        $communication = (new ExampleCase())->teste($configuration);
        $this->assertInstanceOf(CallApi::class, $communication);
    }
}

