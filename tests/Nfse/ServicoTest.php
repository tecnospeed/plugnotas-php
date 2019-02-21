<?php

namespace TecnoSpeed\Plugnotas\Tests\Nfse;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Common\ValorAliquota;
use TecnoSpeed\Plugnotas\Error\ValidationError;
use TecnoSpeed\Plugnotas\Nfse\Servico;
use TecnoSpeed\Plugnotas\Nfse\Servico\Deducao;
use TecnoSpeed\Plugnotas\Nfse\Servico\Evento;
use TecnoSpeed\Plugnotas\Nfse\Servico\Iss;
use TecnoSpeed\Plugnotas\Nfse\Servico\Obra;
use TecnoSpeed\Plugnotas\Nfse\Servico\Retencao;
use TecnoSpeed\Plugnotas\Nfse\Servico\Valor;

class ServicoTest extends TestCase
{
    public function testBuildFromArray()
    {
        $data = [
            'deducao' => [
                'tipo' => 99
            ],
            'evento' => [
                'codigo' => '4051200'
            ],
            'iss' => [
                'aliquota' => 1.01
            ],
            'obra' => [
                'art' => '6270201'
            ],
            'retencao' => [
                'cofins' => [
                    'valor' => 100.10,
                    'aliquota' => 1.01
                ]
            ],
            'valor' => [
                'baseCalculo' => 1010.00
            ]
        ];

        $servico = Servico::fromArray($data);
        $this->assertSame($servico->getDeducao()->getTipo(), 99);
        $this->assertSame($servico->getEvento()->getCodigo(), '4051200');
        $this->assertSame($servico->getIss()->getAliquota(), 1.01);
        $this->assertSame($servico->getObra()->getArt(), '6270201');
        $this->assertSame($servico->getRetencao()->getCofins()->getValor(), 100.10);
        $this->assertSame($servico->getValor()->getBaseCalculo(), 1010.00);
    }

    public function testWithValidData()
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

        $this->assertSame($servico->getCnae(), '4751201');
        $this->assertSame($servico->getCodigo(), '1.02');
        $this->assertSame($servico->getCodigoCidadeIncidencia(), '4115200');
        $this->assertSame($servico->getCodigoTributacao(), '4115200');
        $this->assertSame($servico->getDeducao()->getTipo(), 99);
        $this->assertSame($servico->getDescricaoCidadeIncidencia(), 'MARINGA');
        $this->assertSame($servico->getDiscriminacao(), 'Programação de software');
        $this->assertSame($servico->getEvento()->getCodigo(), '4051200');
        $this->assertSame($servico->getIdIntegracao(), 'A001XT');
        $this->assertSame($servico->getInformacoesLegais(), 'Informações necessárias a serem adicionadas na NFSe');
        $this->assertSame($servico->getIss()->getAliquota(), 0.03);
        $this->assertSame($servico->getObra()->getArt(), '6270201');
        $this->assertSame($servico->getRetencao()->getPis()->getValor(), 606.60);
        $this->assertSame($servico->getValor()->getBaseCalculo(), 0.01);
    }
}
