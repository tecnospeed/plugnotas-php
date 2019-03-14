<?php

namespace TecnoSpeed\Plugnotas\Tests;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Error\RequiredError;
use TecnoSpeed\Plugnotas\Configuration;
use TecnoSpeed\Plugnotas\Nfse;
use TecnoSpeed\Plugnotas\Nfse\Prestador;
use TecnoSpeed\Plugnotas\Nfse\Servico;
use TecnoSpeed\Plugnotas\Nfse\Tomador;

class NfseCommunicationTest extends TestCase
{
    private function fillNfse($nfse)
    {
        $servico = Servico::fromArray([
            'codigo' => '1.02',
            'discriminacao' => 'Exemplo',
            'cnae' => '4751201',
            'iss' => [
                'aliquota' => '3'
            ],
            'valor' => [
                'servico' => 1500.03
            ]
        ]);
        $prestador = Prestador::fromArray([
            'cpfCnpj' => '00.000.000/0001-91',
            'inscricaoMunicipal' => '123456',
            'razaoSocial' => 'Razao Social do Prestador',
            'endereco' => [
                'logradouro' => 'Rua de Teste',
                'numero' => '1234',
                'codigoCidade' => '4115200',
                'cep' => '87.050-800'
            ]
        ]);
        $tomador = Tomador::fromArray([
            'cpfCnpj' => '000.000.001-91',
            'razaoSocial' => 'Razao Social do Tomador'
        ]);
        $nfse->setServico($servico);
        $nfse->setTomador($tomador);
        $nfse->setPrestador($prestador);

        return $nfse;
    }

    private function getNfse($callApi)
    {
        $nfse = $this->getMockBuilder(Nfse::class)
            ->setMethods(['getCallApiInstance'])
            ->getMock();

        $nfse->expects($this->any())
            ->method('getCallApiInstance')
            ->will($this->returnValue($callApi));

        return $nfse;
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Nfse::send
     */
    public function testSendSuccessfull()
    {
        $callApi = $this->getMockBuilder(CallApi::class)
            ->disableOriginalConstructor()
            ->setMethods(['send'])
            ->getMock();

        $callApi->expects($this->once())
            ->method('send')
            ->with(
                $this->equalTo('POST'),
                $this->equalTo('/nfse'),
                $this->anything()
            );

        $configuration = new Configuration();
        $nfse = $this->fillNfse($this->getNfse($callApi));
        $nfse->send($configuration);
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Nfse::find
     */
    public function testFind()
    {
        $callApi = $this->getMockBuilder(CallApi::class)
            ->disableOriginalConstructor()
            ->setMethods(['send'])
            ->getMock();

        $callApi->expects($this->once())
            ->method('send')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('/nfse/1'),
                $this->anything()
            );

        $configuration = new Configuration();
        $nfse = $this->fillNfse($this->getNfse($callApi));
        $nfse->setConfiguration($configuration);
        $nfse->find(1);
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Nfse::findByCnpjAndIdIntegracao
     */
    public function testFindByCnpjAndIdIntegracao()
    {
        $callApi = $this->getMockBuilder(CallApi::class)
            ->disableOriginalConstructor()
            ->setMethods(['send'])
            ->getMock();

        $callApi->expects($this->once())
            ->method('send')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('/nfse/consultar/id/cnpj'),
                $this->anything()
            );

        $configuration = new Configuration();
        $nfse = $this->fillNfse($this->getNfse($callApi));
        $nfse->setConfiguration($configuration);
        $nfse->findByCnpjAndIdIntegracao('cnpj', 'id');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Nfse::findByIdOrProtocol
     */
    public function testFindByIdOrProtocol()
    {
        $callApi = $this->getMockBuilder(CallApi::class)
            ->disableOriginalConstructor()
            ->setMethods(['send'])
            ->getMock();

        $callApi->expects($this->once())
            ->method('send')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('/nfse/consultar/1'),
                $this->anything()
            );

        $configuration = new Configuration();
        $nfse = $this->fillNfse($this->getNfse($callApi));
        $nfse->setConfiguration($configuration);
        $nfse->findByIdOrProtocol(1);
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Nfse::findCancel
     */
    public function testFindCancel()
    {
        $callApi = $this->getMockBuilder(CallApi::class)
            ->disableOriginalConstructor()
            ->setMethods(['send'])
            ->getMock();

        $callApi->expects($this->once())
            ->method('send')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('/nfse/cancelar/status/1'),
                $this->anything()
            );

        $configuration = new Configuration();
        $nfse = $this->fillNfse($this->getNfse($callApi));
        $nfse->setConfiguration($configuration);
        $nfse->findCancel(1);
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Nfse::download
     */
    public function testDownload()
    {
        $callApi = $this->getMockBuilder(CallApi::class)
            ->disableOriginalConstructor()
            ->setMethods(['download'])
            ->getMock();

        $callApi->expects($this->once())
            ->method('download')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('/nfse/xml/1'),
                $this->anything()
            );

        $configuration = new Configuration();
        $configuration->setNfseDownloadDirectory('./examples/tmp/');
        $nfse = $this->fillNfse($this->getNfse($callApi));
        $nfse->setConfiguration($configuration);
        $nfse->download(1);
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Nfse::downloadPdf
     */
    public function testDownloadPdfError()
    {
        $this->expectException(RequiredError::class);
        $this->expectExceptionMessage('É necessário setar o diretório para download do PDF.');

        $configuration = new Configuration();
        $nfse = $this->fillNfse($this->getNfse(new CallApi));
        $nfse->setConfiguration($configuration);
        $nfse->downloadPdf(1);
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Nfse::downloadPdf
     */
    public function testDownloadPdf()
    {
        $callApi = $this->getMockBuilder(CallApi::class)
            ->disableOriginalConstructor()
            ->setMethods(['download'])
            ->getMock();

        $callApi->expects($this->once())
            ->method('download')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('/nfse/pdf/1'),
                $this->anything()
            );

        $configuration = new Configuration();
        $configuration->setNfseDownloadDirectory('./examples/tmp/');
        $nfse = $this->fillNfse($this->getNfse($callApi));
        $nfse->setConfiguration($configuration);
        $nfse->downloadPdf(1);
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Nfse::downloadXml
     */
    public function testDownloadXml()
    {
        $callApi = $this->getMockBuilder(CallApi::class)
            ->disableOriginalConstructor()
            ->setMethods(['download'])
            ->getMock();

        $callApi->expects($this->once())
            ->method('download')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('/nfse/xml/1'),
                $this->anything()
            );

        $configuration = new Configuration();
        $configuration->setNfseDownloadDirectory('./examples/tmp/');
        $nfse = $this->fillNfse($this->getNfse($callApi));
        $nfse->setConfiguration($configuration);
        $nfse->downloadXml(1);
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Nfse::downloadXml
     */
    public function testDownloadXmlError()
    {
        $this->expectException(RequiredError::class);
        $this->expectExceptionMessage('É necessário setar o diretório para download do XML.');

        $configuration = new Configuration();
        $nfse = $this->fillNfse($this->getNfse(new CallApi));
        $nfse->setConfiguration($configuration);
        $nfse->downloadXml(1);
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Nfse::downloadPdfByCnpjAndIdIntegracao
     */
    public function testDownloadPdfByCnpjAndIdIntegracao()
    {
        $callApi = $this->getMockBuilder(CallApi::class)
            ->disableOriginalConstructor()
            ->setMethods(['download'])
            ->getMock();

        $callApi->expects($this->once())
            ->method('download')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('/nfse/pdf/integracao/cnpj'),
                $this->anything()
            );

        $configuration = new Configuration();
        $configuration->setNfseDownloadDirectory('./examples/tmp/');
        $nfse = $this->fillNfse($this->getNfse($callApi));
        $nfse->setConfiguration($configuration);
        $nfse->downloadPdfByCnpjAndIdIntegracao('cnpj', 'integracao');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Nfse::downloadPdfByCnpjAndIdIntegracao
     */
    public function testDownloadPdfByCnpjAndIdIntegracaoError()
    {
        $this->expectException(RequiredError::class);
        $this->expectExceptionMessage('É necessário setar o diretório para download do PDF.');

        $configuration = new Configuration();
        $nfse = $this->fillNfse($this->getNfse(new CallApi));
        $nfse->setConfiguration($configuration);
        $nfse->downloadPdfByCnpjAndIdIntegracao('cnpj', 'integracao');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Nfse::downloadXmlByCnpjAndIdIntegracao
     */
    public function testDownloadXmlByCnpjAndIdIntegracao()
    {
        $callApi = $this->getMockBuilder(CallApi::class)
            ->disableOriginalConstructor()
            ->setMethods(['download'])
            ->getMock();

        $callApi->expects($this->once())
            ->method('download')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('/nfse/xml/integracao/cnpj'),
                $this->anything()
            );

        $configuration = new Configuration();
        $configuration->setNfseDownloadDirectory('./examples/tmp/');
        $nfse = $this->fillNfse($this->getNfse($callApi));
        $nfse->setConfiguration($configuration);
        $nfse->downloadXmlByCnpjAndIdIntegracao('cnpj', 'integracao');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Nfse::downloadXmlByCnpjAndIdIntegracao
     */
    public function testDownloadXmlByCnpjAndIdIntegracaoError()
    {
        $this->expectException(RequiredError::class);
        $this->expectExceptionMessage('É necessário setar o diretório para download do XML.');

        $configuration = new Configuration();
        $nfse = $this->fillNfse($this->getNfse(new CallApi));
        $nfse->setConfiguration($configuration);
        $nfse->downloadXmlByCnpjAndIdIntegracao('cnpj', 'integracao');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Nfse::cancel
     */
    public function testCancel()
    {
        $callApi = $this->getMockBuilder(CallApi::class)
            ->disableOriginalConstructor()
            ->setMethods(['send'])
            ->getMock();

        $callApi->expects($this->once())
            ->method('send')
            ->with(
                $this->equalTo('POST'),
                $this->equalTo('/nfse/cancelar/1'),
                $this->anything()
            );

        $configuration = new Configuration();
        $nfse = $this->fillNfse($this->getNfse($callApi));
        $nfse->setConfiguration($configuration);
        $nfse->cancel(1);
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Nfse::cancelByCnpjAndIdIntegracao
     */
    public function testCancelByCnpjAndIdIntegracao()
    {
        $callApi = $this->getMockBuilder(CallApi::class)
            ->disableOriginalConstructor()
            ->setMethods(['send'])
            ->getMock();

        $callApi->expects($this->once())
            ->method('send')
            ->with(
                $this->equalTo('POST'),
                $this->equalTo('/nfse/cancelar/integracao/cnpj'),
                $this->anything()
            );

        $configuration = new Configuration();
        $nfse = $this->fillNfse($this->getNfse($callApi));
        $nfse->setConfiguration($configuration);
        $nfse->cancelByCnpjAndIdIntegracao('cnpj', 'integracao');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Nfse::cancelStatus
     */
    public function testCancelStatus()
    {
        $callApi = $this->getMockBuilder(CallApi::class)
            ->disableOriginalConstructor()
            ->setMethods(['send'])
            ->getMock();

        $callApi->expects($this->once())
            ->method('send')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('/nfse/cancelar/status/id'),
                $this->anything()
            );

        $configuration = new Configuration();
        $nfse = $this->fillNfse($this->getNfse($callApi));
        $nfse->setConfiguration($configuration);
        $nfse->cancelStatus('id');
    }
}

