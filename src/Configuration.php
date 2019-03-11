<?php
namespace TecnoSpeed\Plugnotas;

class Configuration
{
    const API_KEY_SANDBOX = '2da392a6-79d2-4304-a8b7-959572c7e44d';
    const TYPE_ENVIRONMENT_SANDBOX = 'sandbox';
    const TYPE_ENVIRONMENT_PRODUCTION = 'production';
    const URL_PRODUCTION = 'https://api.plugnotas.com.br';
    const URL_SANDBOX = 'https://api.sandbox.plugnotas.com.br';

    private $apiKey = self::API_KEY_SANDBOX;
    private $environment = self::TYPE_ENVIRONMENT_SANDBOX;
    private $nfseDownloadDirectory;

    public function __construct($environment = self::TYPE_ENVIRONMENT_SANDBOX, $apiKey = self::API_KEY_SANDBOX)
    {
        $this->setEnvironment($environment);
        $this->setApiKey($apiKey);
    }

    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function setEnvironment($environment)
    {
        $this->environment = $environment;
    }

    public function getEnvironment()
    {
        return $this->environment;
    }

    public function getUrl()
    {
        if ($this->getEnvironment() === self::TYPE_ENVIRONMENT_PRODUCTION) {
            return self::URL_PRODUCTION;
        }

        return self::URL_SANDBOX;
    }

    public function setNfseDownloadDirectory($directory)
    {
        $this->nfseDownloadDirectory = $directory;
    }

    public function getNfseDownloadDirectory()
    {
        return $this->nfseDownloadDirectory;
    }
}
