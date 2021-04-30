<?php

require '../vendor/autoload.php';

use TecnoSpeed\Plugnotas\Common\Endereco;
use TecnoSpeed\Plugnotas\Common\Telefone;
use TecnoSpeed\Plugnotas\Common\ValorAliquota;
use TecnoSpeed\Plugnotas\Common\PisCofinsValorAliquota;
use TecnoSpeed\Plugnotas\Configuration;

use TecnoSpeed\Plugnotas\Nfse;
use TecnoSpeed\Plugnotas\Nfse\Parcelas;
use TecnoSpeed\Plugnotas\Nfse\Intermediario;
use TecnoSpeed\Plugnotas\Nfse\CamposExtras;
use TecnoSpeed\Plugnotas\Nfse\CidadePrestacao;
use TecnoSpeed\Plugnotas\Nfse\CargaTributaria;
use TecnoSpeed\Plugnotas\Nfse\Impressao;
use TecnoSpeed\Plugnotas\Nfse\Prestador;
use TecnoSpeed\Plugnotas\Nfse\Rps;
use TecnoSpeed\Plugnotas\Nfse\Servico;
use TecnoSpeed\Plugnotas\Nfse\Servico\Deducao;
use TecnoSpeed\Plugnotas\Nfse\Servico\Evento;
use TecnoSpeed\Plugnotas\Nfse\Servico\Iss;
use TecnoSpeed\Plugnotas\Nfse\Servico\Ibpt;
use TecnoSpeed\Plugnotas\Nfse\Servico\Obra;
use TecnoSpeed\Plugnotas\Nfse\Servico\Retencao;
use TecnoSpeed\Plugnotas\Nfse\Servico\Valor;
use TecnoSpeed\Plugnotas\Nfse\Tomador;
use TecnoSpeed\Plugnotas\Error\RequiredError;
use TecnoSpeed\Plugnotas\Error\ValidationError;

try {


    $aliquotaSimplificado = ["aliquota" => 0];
    $aliquotaDetalahdo = ['aliquota' => ['municipal' => 0,'estadual' => 0,'federal' => 0]];


    // Criando os objetos auxiliares necessários e o objeto Prestador
    $enderecoPrestador = new Endereco();
    $enderecoPrestador->setTipoLogradouro('Avenida');
    $enderecoPrestador->setLogradouro('Duque de Caxias');
    $enderecoPrestador->setNumero('882');
    $enderecoPrestador->setComplemento('17 andar');
    $enderecoPrestador->setTipoBairro('Zona');
    $enderecoPrestador->setBairro('Zona 7');
    $enderecoPrestador->setCodigoPais(1058);
    $enderecoPrestador->setDescricaoPais('Brasil');
    $enderecoPrestador->setCodigoCidade('4115200');
    $enderecoPrestador->setDescricaoCidade('Maringá');
    $enderecoPrestador->setEstado('PR');
    $enderecoPrestador->setCep('87.020-025');
    
    $telefonePrestador = new Telefone('44', '1234-1234');
    
    $prestador = new Prestador();
    $prestador->setCpfCnpj('00.000.000/0001-91');
    $prestador->setInscricaoMunicipal('8214100099');
    $prestador->setInscricaoEstadual('21548818154845');
    $prestador->setRazaoSocial('Empresa Teste LTDA');
    $prestador->setNomeFantasia('Empresa Teste');
    $prestador->setSimplesNacional(true);
    $prestador->setRegimeTributario(0);
    $prestador->setIncentivoFiscal(false);
    $prestador->setIncentivadorCultural(false);
    $prestador->setRegimeTributarioEspecial(0);
    $prestador->setEndereco($enderecoPrestador);
    $prestador->setTelefone($telefonePrestador);
    $prestador->setEmail('teste@plugnotas.com.br');
    
    // Criando os objetos auxiliares necessários e o objeto Tomador
    $enderecoTomador = new Endereco();
    $enderecoTomador->setTipoLogradouro('Avenida');
    $enderecoTomador->setLogradouro('Duque de Caxias');
    $enderecoTomador->setNumero('882');
    $enderecoTomador->setComplemento('17 andar');
    $enderecoTomador->setTipoBairro('Zona');
    $enderecoTomador->setBairro('Zona 7');
    $enderecoTomador->setCodigoPais(1058);
    $enderecoTomador->setDescricaoPais('Brasil');
    $enderecoTomador->setCodigoCidade('4115200');
    $enderecoTomador->setDescricaoCidade('Maringá');
    $enderecoTomador->setEstado('PR');
    $enderecoTomador->setCep('87.020-025');

    $telefoneTomador = new Telefone('44', '1234-1234');

    $tomador = new Tomador();
    $tomador->setCpfCnpj('00.000.000/0001-91');
    $tomador->setInscricaoMunicipal('654646646343');
    $tomador->setInscricaoEstadual('8214100099');
    $tomador->setInscricaoSuframa("12112145454");
    $tomador->setIndicadorInscricaoEstadual(9);
    $tomador->setRazaoSocial('Empresa Teste LTDA');
    $tomador->setNomeFantasia('Empresa Teste');
    $tomador->setEndereco($enderecoTomador);
    $tomador->setTelefone($telefoneTomador);
    $tomador->setEmail('teste@plugnotas.com.br');
    $tomador->setOrgaoPublico(false);

    $intermediario = new Intermediario();
    $intermediario->setTipo(0);
    $intermediario->setCpfCnpj('00.000.000/0001-91');
    $intermediario->setRazaoSocial('Empresa Teste LTDA');
    $intermediario->setInscricaoMunicipal('654646646343');

    // Criando os objetos auxiliares necessários e o objeto Servico
    $deducao = new Deducao();
    $deducao->setTipo(99);
    $deducao->setDescricao('Teste de deducao');
    
    
    $iss = new Iss();
    $iss->setTipoTributacao(1);
    $iss->setExigibilidade(1);
    $iss->setRetido(false);
    $iss->setAliquota(0.03);
    $iss->setValor(12.30);
    $iss->setValorRetido(1.23);
    $iss->setProcessoSuspensao('1234');

    
    $obra = new Obra();
    $obra->setArt('6270201');
    $obra->setCodigo('21');
    $obra->setCei('12345678910');
    
    $retencao = new Retencao();
    $retencao->setPis(new PisCofinsValorAliquota(606.60, 6.06, 0.00));
    $retencao->setCofins(new PisCofinsValorAliquota(100.10, 1.01,0.00));
    $retencao->setCsll(new ValorAliquota(202.20, 2.02));
    $retencao->setInss(new ValorAliquota(303.30, 3.03));
    $retencao->setIrrf(new ValorAliquota(404.40, 4.04));
    $retencao->setOutrasRetencoes(505.50);
    $retencao->setCpp(new ValorAliquota(303.30, 3.03));

    
    $valor = new Valor();
    $valor->setServico(0.06);
    $valor->setBaseCalculo(0.01);
    $valor->setDeducoes(0.02);
    $valor->setDescontoCondicionado(0.03);
    $valor->setDescontoIncondicionado(0.04);
    $valor->setLiquido(0.05);
    $valor->setUnitario(1);
    $valor->setValorAproximadoTributos(0.07);


     $ibpt = new Ibpt();
     $ibpt->setSimplificado($aliquotaSimplificado);   
     $ibpt->setDetalhado($aliquotaDetalahdo);
    
    $services = [];
    $servico = new Servico();
    $servico->setCodigo('1.02');
    $servico->setIdIntegracao('A001XT');
    $servico->setDiscriminacao('Programação de software');
    $servico->setCodigoTributacao('4115200');
    $servico->setCnae('4751201');
    $servico->setCodigoCidadeIncidencia('4115200');
    $servico->setDescricaoCidadeIncidencia('MARINGA');
    $servico->setUnidade(1);
    $servico->setQuantidade(1);
    $servico->setIss($iss);
    $servico->setObra($obra);
    $servico->setValor($valor);
    $servico->setDeducao($deducao);
    $servico->setRetencao($retencao);
    $servico->setTributavel(false);
    $servico->setIbpt($ibpt);
    $servico->setResponsavelRetencao(2);
    array_push($services, $servico->toArray());
      
      
    
    

    // Criando os objetos auxiliares necessários e o objeto Rps
    $dateEmission = new \DateTime('now');
    

    $rps = new Rps();
    $rps->setDataEmissao($dateEmission);
    $rps->setCompetencia($dateEmission);
  


    // Criando os objetos auxiliares necessários e o objeto CidadePrestacao
    $cidadePrestacao = new CidadePrestacao();
    $cidadePrestacao->setCodigo('4115200');
    $cidadePrestacao->setDescricao('MARINGA');
    $cidadePrestacao->setTipoLogradouro('Rua');
    $cidadePrestacao->setLogradouro("Teste A");
    $cidadePrestacao->setNumero("1705");
    $cidadePrestacao->setComplemento("Casa");
    $cidadePrestacao->setTipoBairro("Chácara");
    $cidadePrestacao->setBairro("Bairro A");
    $cidadePrestacao->setEstado("PR");
    $cidadePrestacao->setCep("87010-890");

    $cargaTributaria = new CargaTributaria();
    $cargaTributaria->setValor(1);
    $cargaTributaria->setPercentual(0.5);
    $cargaTributaria->setFonte('teste');

    // Criando configuração (este objeto é onde você irá colocar seu api-key)
    $configuration = new Configuration(
        Configuration::TYPE_ENVIRONMENT_SANDBOX, // Ambiente a ser enviada a requisição
        '2da392a6-79d2-4304-a8b7-959572c7e44d' // API-Key
    );

    $impressao = new Impressao();
    $impressao->setCamposCustomizados([
       'inscricaoMunicipalTomador' => '123456'
    ]);

    $camposExtras = new CamposExtras();
    $camposExtras->setCopiasEmail(['teste@plugnotas.com.br','teste2@plugnotas.com.br']);
    
  
    $parcelas = new Parcelas();
    $parcelas->setTipoPagamento(1);
    $parcelas->setNumero(1);
    $parcelas->setDataVencimento('2021-04-29T19:04:49.488Z');
    $parcelas->setValor(0.01);


    // Criando uma NFSe
    $nfse = new Nfse();
    $nfse->setIdIntegracao('ABC12345678910111213');
    $nfse->setEnviarEmail(true);
    $nfse->setRps($rps);
    $nfse->setCidadePrestacao($cidadePrestacao);
    $nfse->setIdNotaSubstituida("608af4c3778d437fa5ed80a9");
    $nfse->setNaturezaTributacao(1);
    $nfse->setPrestador($prestador);
    $nfse->setTomador($tomador);
    $nfse->setIntermediario($intermediario);
    $nfse->setServico($services);
    $nfse->setCargaTributaria($cargaTributaria);
    $nfse->setImpressao($impressao);
    $nfse->setDescricao("Descrição do RPS e serviços prestados.");
    $nfse->setCamposExtras($camposExtras);
    $nfse->setInformacoesComplementares("Informações complementares a nota.");
    $nfse->setParcelas($parcelas);

    $response = $nfse->send($configuration); // A resposta sempre será um objeto TecnoSpeed\Plugnotas\Communication\Response
    var_dump($response);
} catch (ValidationError $e) {
    // Algum campo foi informado no formato errado
    var_dump($e);
} catch (RequiredError $e) {
    // Campos requeridos não foram informados
    var_dump($e);
} catch (\Exception $e) {
    // Algum erro não esperado
    var_dump($e);
}
