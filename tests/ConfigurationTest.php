<?php
namespace TecnoSpeed\Plugnotas\Tests;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Configuration;

final class ConfigurationTest extends TestCase
{
    public function testConstructorSetter()
    {
        $configuration = new Configuration(Configuration::TYPE_ENVIRONMENT_PRODUCTION, 'test-api-key');
        $this->assertSame($configuration->getEnvironment(), Configuration::TYPE_ENVIRONMENT_PRODUCTION);
        $this->assertSame($configuration->getApiKey(), 'test-api-key');
        $this->assertSame($configuration->getUrl(), 'https://api.plugnotas.com.br');
    }

    public function testDefaultUrlAndEnvironment()
    {
        $configuration = new Configuration();
        $this->assertSame($configuration->getEnvironment(), Configuration::TYPE_ENVIRONMENT_SANDBOX);
        $this->assertSame($configuration->getUrl(), 'https://api.sandbox.plugnotas.com.br');
    }

    public function testTestChangeEnvironment()
    {
        $configuration = new Configuration();
        $configuration->setEnvironment(Configuration::TYPE_ENVIRONMENT_PRODUCTION);
        $this->assertSame($configuration->getEnvironment(), Configuration::TYPE_ENVIRONMENT_PRODUCTION);
        $this->assertSame($configuration->getUrl(), 'https://api.plugnotas.com.br');
    }

    public function testWithNfseDownloadDirectory()
    {
        $configuration = new Configuration();
        $configuration->setNfseDownloadDirectory('/some/test/directory/');
        $this->assertSame($configuration->getNfseDownloadDirectory(), '/some/test/directory/');
    }
}
