<?php

namespace TecnoSpeed\Plugnotas\Tests;


use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Builders\NfseBuilder;
use TecnoSpeed\Plugnotas\Common\Endereco;
use TecnoSpeed\Plugnotas\Common\Telefone;
use TecnoSpeed\Plugnotas\Common\ValorAliquota;
use TecnoSpeed\Plugnotas\Configuration;
use TecnoSpeed\Plugnotas\Error\RequiredError;
use TecnoSpeed\Plugnotas\Error\ValidationError;
use TecnoSpeed\Plugnotas\Nfse;
use TecnoSpeed\Plugnotas\Nfse\CidadePrestacao;
use TecnoSpeed\Plugnotas\Nfse\Impressao;
use TecnoSpeed\Plugnotas\Nfse\Prestador;
use TecnoSpeed\Plugnotas\Nfse\Rps;
use TecnoSpeed\Plugnotas\Nfse\Servico;
use TecnoSpeed\Plugnotas\Nfse\Servico\Deducao;
use TecnoSpeed\Plugnotas\Nfse\Servico\Evento;
use TecnoSpeed\Plugnotas\Nfse\Servico\Iss;
use TecnoSpeed\Plugnotas\Nfse\Servico\Obra;
use TecnoSpeed\Plugnotas\Nfse\Servico\Retencao;
use TecnoSpeed\Plugnotas\Nfse\Servico\Valor;
use TecnoSpeed\Plugnotas\Nfse\Tomador;

class NfseTest extends TestCase
{
    public function testEnviarEmailWithInvalidValue()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('enviarEmail deve ser um valor booleano.');
        $nfse = new Nfse();
        $nfse->setEnviarEmail('teste');
    }

    public function testSubstituicaoWithInvalidValue()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Substituicao deve ser um valor booleano.');
        $nfse = new Nfse();
        $nfse->setSubstituicao('teste');
    }

    private function getPrestador()
    {
        $endereco = new Endereco();
        $endereco->setTipoLogradouro('Avenida');
        $endereco->setLogradouro('Duque de Caxias');
        $endereco->setNumero('882');
        $endereco->setComplemento('17 andar');
        $endereco->setTipoBairro('Zona');
        $endereco->setBairro('Zona 7');
        $endereco->setCodigoCidade('4115200');
        $endereco->setDescricaoCidade('Maringá');
        $endereco->setEstado('PR');
        $endereco->setCep('87.020-025');

        $telefone = new Telefone('44', '1234-1234');

        $prestador = new Prestador();
        $prestador->setCertificado('5b855b0926ddb251e0f0ef42');
        $prestador->setCpfCnpj('00.000.000/0001-91');
        $prestador->setEmail('teste@plugnotas.com.br');
        $prestador->setEndereco($endereco);
        $prestador->setIncentivadorCultural(false);
        $prestador->setIncentivoFiscal(false);
        $prestador->setInscricaoMunicipal('8214100099');
        $prestador->setNomeFantasia('Empresa Teste');
        $prestador->setRazaoSocial('Empresa Teste LTDA');
        $prestador->setRegimeTributario(0);
        $prestador->setRegimeTributarioEspecial(0);
        $prestador->setSimplesNacional(0);
        $prestador->setTelefone($telefone);

        return $prestador;
    }

    private function getServico()
    {
        $deducao = new Deducao();
        $deducao->setTipo(99);
        $deducao->setDescricao('Teste de deducao');

        $evento = new Evento();
        $evento->setCodigo('4051200');
        $evento->setDescricao('CONFERENCIA');

        $iss = new Iss();
        $iss->setAliquota(0.03);
        $iss->setExigibilidade(1);
        $iss->setProcessoSuspensao('1234');
        $iss->setRetido(true);
        $iss->setTipoTributacao(1);
        $iss->setValor(12.30);
        $iss->setValorRetido(1.23);

        $obra = new Obra();
        $obra->setArt('6270201');
        $obra->setCodigo('21');

        $retencao = new Retencao();
        $retencao->setCofins(new ValorAliquota(100.10, 1.01));
        $retencao->setCsll(new ValorAliquota(202.20, 2.02));
        $retencao->setInss(new ValorAliquota(303.30, 3.03));
        $retencao->setIrrf(new ValorAliquota(404.40, 4.04));
        $retencao->setOutrasRetencoes(new ValorAliquota(505.50, 5.05));
        $retencao->setPis(new ValorAliquota(606.60, 6.06));

        $valor = new Valor();
        $valor->setBaseCalculo(0.01);
        $valor->setDeducoes(0.02);
        $valor->setDescontoCondicionado(0.03);
        $valor->setDescontoIncondicionado(0.04);
        $valor->setLiquido(0.05);
        $valor->setServico(0.06);

        $servico = new Servico();
        $servico->setCnae('4751201');
        $servico->setCodigo('1.02');
        $servico->setCodigoCidadeIncidencia('4115200');
        $servico->setCodigoTributacao('4115200');
        $servico->setDeducao($deducao);
        $servico->setDescricaoCidadeIncidencia('MARINGA');
        $servico->setDiscriminacao('Programação de software');
        $servico->setEvento($evento);
        $servico->setIdIntegracao('A001XT');
        $servico->setInformacoesLegais('Informações necessárias a serem adicionadas na NFSe');
        $servico->setIss($iss);
        $servico->setObra($obra);
        $servico->setRetencao($retencao);
        $servico->setValor($valor);

        return $servico;
    }

    private function getTomador()
    {
        $endereco = new Endereco();
        $endereco->setTipoLogradouro('Avenida');
        $endereco->setLogradouro('Duque de Caxias');
        $endereco->setNumero('882');
        $endereco->setComplemento('17 andar');
        $endereco->setTipoBairro('Zona');
        $endereco->setBairro('Zona 7');
        $endereco->setCodigoCidade('4115200');
        $endereco->setDescricaoCidade('Maringá');
        $endereco->setEstado('PR');
        $endereco->setCep('87.020-025');

        $telefone = new Telefone('44', '1234-1234');

        $tomador = new Tomador();
        $tomador->setCpfCnpj('00.000.000/0001-91');
        $tomador->setEmail('teste@plugnotas.com.br');
        $tomador->setEndereco($endereco);
        $tomador->setInscricaoEstadual('8214100099');
        $tomador->setNomeFantasia('Empresa Teste');
        $tomador->setRazaoSocial('Empresa Teste LTDA');
        $tomador->setTelefone($telefone);

        return $tomador;
    }

    public function testWithValidData()
    {
        $cidadePrestacao = new CidadePrestacao();
        $cidadePrestacao->setCodigo('1234');
        $cidadePrestacao->setDescricao('Cidade de Teste');

        $dateCompare = new \DateTime('now');
        $rps = new Rps();
        $rps->setDataEmissao($dateCompare);
        $rps->setCompetencia($dateCompare);

        $impressao = new Impressao();
        $impressao->setCamposCustomizados(['teste'=>'testeImpressao']);

        $configuration = new Configuration();

        $nfse = new Nfse();
        $nfse->setCidadePrestacao($cidadePrestacao);
        $nfse->setEnviarEmail(false);
        $nfse->setIdIntegracao(1234);
        $nfse->setImpressao($impressao);
        $nfse->setPrestador($this->getPrestador());
        $nfse->setRps($rps);
        $nfse->setServico($this->getServico());
        $nfse->setSubstituicao(false);
        $nfse->setTomador($this->getTomador());
        $nfse->setConfiguration($configuration);

        $this->assertSame($nfse->getCidadePrestacao()->getDescricao(), 'Cidade de Teste');
        $this->assertSame($nfse->getEnviarEmail(), false);
        $this->assertSame($nfse->getIdIntegracao(), 1234);
        $this->assertSame($nfse->getImpressao()->getCamposCustomizados()['teste'], 'testeImpressao');
        $this->assertSame($nfse->getPrestador()->getCertificado(), '5b855b0926ddb251e0f0ef42');
        $this->assertSame($nfse->getRps()->getDataEmissao(), $dateCompare->format('Y-m-d\TH:i:s'));
        $this->assertSame($nfse->getServico()->getIdIntegracao(), 'A001XT');
        $this->assertSame($nfse->getSubstituicao(), false);
        $this->assertSame($nfse->getTomador()->getCpfCnpj(), '00000000000191');
        $this->assertInstanceOf(Configuration::class, $nfse->getConfiguration());
    }

    public function testCreateObjectFromArray()
    {
        $data = [
            'cidadePrestacao' => [
                'codigo' => '123'
            ],
            'tomador' => [
                'cpfCnpj' => '00.000.000/0001-91',
                'razaoSocial' => 'Tomador Teste'
            ],
            'prestador' => [
                'cpfCnpj' => '00.000.000/0001-91',
                'razaoSocial' => 'Prestador Teste'
            ],
            'servico' => [
                'iss' => [
                    'aliquota' => 1.01
                ]
            ],
            'rps' => [
                'dataEmissao' => new \DateTime('2019-02-27')
            ],
            'impressao' => [
                'camposCustomizados' => [
                    'teste' => 'teste impressao'
                ]
            ]
        ];

        $nfse = Nfse::fromArray($data);
        $this->assertInstanceOf(CidadePrestacao::class, $nfse->getCidadePrestacao());
        $this->assertInstanceOf(Prestador::class, $nfse->getPrestador());
        $this->assertInstanceOf(Rps::class, $nfse->getRps());
        $this->assertInstanceOf(Servico::class, $nfse->getServico());
        $this->assertInstanceOf(Tomador::class, $nfse->getTomador());
        $this->assertInstanceOf(Impressao::class, $nfse->getImpressao());
    }

    public function testCreateObjectFromArrayWithOneObject()
    {
        $data = [
            'cidadePrestacao' => [
                'codigo' => '123'
            ],
            'tomador' => [
                'cpfCnpj' => '00.000.000/0001-91',
                'razaoSocial' => 'Tomador Teste'
            ],
            'prestador' => [
                'cpfCnpj' => '00.000.000/0001-91',
                'razaoSocial' => 'Prestador Teste'
            ],
            'servico' => [
                'iss' => [
                    'aliquota' => 1.01
                ]
            ],
            'rps' => [
                'dataEmissao' => new \DateTime('2019-02-27')
            ],
            'impressao' => Impressao::fromArray([
                'camposCustomizados' => [
                    'teste' => 'teste impressao'
                ]
            ])
        ];

        $nfse = Nfse::fromArray($data);
        $this->assertInstanceOf(CidadePrestacao::class, $nfse->getCidadePrestacao());
        $this->assertInstanceOf(Prestador::class, $nfse->getPrestador());
        $this->assertInstanceOf(Rps::class, $nfse->getRps());
        $this->assertInstanceOf(Servico::class, $nfse->getServico());
        $this->assertInstanceOf(Tomador::class, $nfse->getTomador());
        $this->assertInstanceOf(Impressao::class, $nfse->getImpressao());
    }

    public function testValidateWithValidData()
    {
        $nfse = (new NfseBuilder)
            ->withPrestador([
                'cpfCnpj' => '00.000.000/0001-91',
                'inscricaoMunicipal' => '123456',
                'razaoSocial' => 'Razao Social do Prestador',
                'endereco' => [
                    'logradouro' => 'Rua de Teste',
                    'numero' => '1234',
                    'codigoCidade' => '4115200',
                    'cep' => '87.050-800'
                ]
            ])
            ->withTomador([
                'cpfCnpj' => '000.000.001-91',
                'razaoSocial' => 'Razao Social do Tomador'
            ])
            ->withServico([
                'codigo' => '1.02',
                'discriminacao' => 'Exemplo',
                'cnae' => '4751201',
                'iss' => [
                    'aliquota' => '3'
                ],
                'valor' => [
                    'servico' => 1500.03
                ]
            ])
            ->build([]);
        $this->assertTrue($nfse->validate());
    }

    public function testValidateWithIncompleteData()
    {
        $this->expectException(RequiredError::class);
        $this->expectExceptionMessage(
            'Os parâmetros mínimos para criar uma Nfse não foram preenchidos.'
        );
        $nfse = (new NfseBuilder)->build([]);
        $nfse->validate();
    }
}
