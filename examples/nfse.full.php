<?php

require '../vendor/autoload.php';

use TecnoSpeed\Plugnotas\Common\Endereco;
use TecnoSpeed\Plugnotas\Common\Telefone;
use TecnoSpeed\Plugnotas\Common\ValorAliquota;
use TecnoSpeed\Plugnotas\Configuration;
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
use TecnoSpeed\Plugnotas\Error\RequiredError;
use TecnoSpeed\Plugnotas\Error\ValidationError;

try {
    // Criando os objetos auxiliares necessários e o objeto Prestador
    $enderecoPrestador = new Endereco();
    $enderecoPrestador->setTipoLogradouro('Avenida');
    $enderecoPrestador->setLogradouro('Duque de Caxias');
    $enderecoPrestador->setNumero('882');
    $enderecoPrestador->setComplemento('17 andar');
    $enderecoPrestador->setTipoBairro('Zona');
    $enderecoPrestador->setBairro('Zona 7');
    $enderecoPrestador->setCodigoCidade('4115200');
    $enderecoPrestador->setDescricaoCidade('Maringá');
    $enderecoPrestador->setEstado('PR');
    $enderecoPrestador->setCep('87.020-025');

    $telefonePrestador = new Telefone('44', '1234-1234');

    $prestador = new Prestador();
    $prestador->setCertificado('5b855b0926ddb251e0f0ef42');
    $prestador->setCpfCnpj('00.000.000/0001-91');
    $prestador->setEmail('teste@plugnotas.com.br');
    $prestador->setEndereco($enderecoPrestador);
    $prestador->setIncentivadorCultural(false);
    $prestador->setIncentivoFiscal(false);
    $prestador->setInscricaoMunicipal('8214100099');
    $prestador->setNomeFantasia('Empresa Teste');
    $prestador->setRazaoSocial('Empresa Teste LTDA');
    $prestador->setRegimeTributario(0);
    $prestador->setRegimeTributarioEspecial(0);
    $prestador->setSimplesNacional(0);
    $prestador->setTelefone($telefonePrestador);

    // Criando os objetos auxiliares necessários e o objeto Tomador
    $enderecoTomador = new Endereco();
    $enderecoTomador->setTipoLogradouro('Avenida');
    $enderecoTomador->setLogradouro('Duque de Caxias');
    $enderecoTomador->setNumero('882');
    $enderecoTomador->setComplemento('17 andar');
    $enderecoTomador->setTipoBairro('Zona');
    $enderecoTomador->setBairro('Zona 7');
    $enderecoTomador->setCodigoCidade('4115200');
    $enderecoTomador->setDescricaoCidade('Maringá');
    $enderecoTomador->setEstado('PR');
    $enderecoTomador->setCep('87.020-025');

    $telefoneTomador = new Telefone('44', '1234-1234');

    $tomador = new Tomador();
    $tomador->setCpfCnpj('00.000.000/0001-91');
    $tomador->setEmail('teste@plugnotas.com.br');
    $tomador->setEndereco($enderecoTomador);
    $tomador->setInscricaoEstadual('8214100099');
    $tomador->setNomeFantasia('Empresa Teste');
    $tomador->setRazaoSocial('Empresa Teste LTDA');
    $tomador->setTelefone($telefoneTomador);

    // Criando os objetos auxiliares necessários e o objeto Servico
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
    $retencao->setOutrasRetencoes(505.50);
    $retencao->setPis(new ValorAliquota(606.60, 6.06));

    $valor = new Valor();
    $valor->setBaseCalculo(0.01);
    $valor->setDeducoes(0.02);
    $valor->setDescontoCondicionado(0.03);
    $valor->setDescontoIncondicionado(0.04);
    $valor->setLiquido(0.05);
    $valor->setServico(0.06);

    $services = [];
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

    // Criando configuração (este objeto é onde você irá colocar seu api-key)
    $configuration = new Configuration(
        Configuration::TYPE_ENVIRONMENT_SANDBOX, // Ambiente a ser enviada a requisição
        '2da392a6-79d2-4304-a8b7-959572c7e44d' // API-Key
    );

    $impressao = new Impressao();
    $impressao->setCamposCustomizados([
       'inscricaoMunicipalTomador' => '123456'
    ]);

    // Criando uma NFSe
    $nfse = new Nfse();
    $nfse->setCidadePrestacao($cidadePrestacao);
    $nfse->setEnviarEmail(true);
    $nfse->setIdIntegracao('ABC123');
    $nfse->setImpressao($impressao);
    $nfse->setPrestador($prestador);
    $nfse->setRps($rps);
    $nfse->setServico($services);
    $nfse->setSubstituicao(false);
    $nfse->setTomador($tomador);

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
