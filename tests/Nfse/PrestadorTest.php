<?php

namespace TecnoSpeed\Plugnotas\Tests\Nfse;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Common\Endereco;
use TecnoSpeed\Plugnotas\Common\Telefone;
use TecnoSpeed\Plugnotas\Error\ValidationError;
use TecnoSpeed\Plugnotas\Nfse\Prestador;

class PrestadorTest extends TestCase
{
    public function testWithInvlidaCertificateId()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('ID de certificado Inválido.');
        $prestador = new Prestador();
        $prestador->setCertificado('123ASD');
    }

    public function testWithInvalidLengthCpfCnpj()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Campo cpfCnpj deve ter 11 ou 14 números.');
        $prestador = new Prestador();
        $prestador->setCpfCnpj('12345678901234567890');
    }

    public function testWithInvalidCpfFormation()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('CPF inválido.');
        $prestador = new Prestador();
        $prestador->setCpfCnpj('123.456.789-01');
    }

    public function testWithInvalidCnpjFormation()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('CNPJ inválido.');
        $prestador = new Prestador();
        $prestador->setCpfCnpj('12.345.678/0001-90');
    }

    public function testWithNullSimplesNacional()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Optante do Simples nacional é requerida para NFSe.');
        $prestador = new Prestador();
        $prestador->setSimplesNacional(null);
    }

    public function testWithNullRazaoSocial()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Razão social é requerida para NFSe.');
        $prestador = new Prestador();
        $prestador->setRazaoSocial(null);
    }

    public function testWithNullIncricaoMunicipal()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Inscrição municipal é requerida para NFSe.');
        $prestador = new Prestador();
        $prestador->setInscricaoMunicipal(null);
    }

    public function testWithInvalidEmail()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Endereço de email inválido.');
        $prestador = new Prestador();
        $prestador->setEmail('teste');
    }

    public function testValidPrestadorCreation()
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

        $this->assertSame($prestador->getCertificado(), '5b855b0926ddb251e0f0ef42');
        $this->assertSame($prestador->getCpfCnpj(), '00000000000191');
        $this->assertSame($prestador->getEmail(), 'teste@plugnotas.com.br');
        $this->assertSame($prestador->getEndereco()->getCep(), '87020025');
        $this->assertSame($prestador->getIncentivadorCultural(), false);
        $this->assertSame($prestador->getIncentivoFiscal(), false);
        $this->assertSame($prestador->getInscricaoMunicipal(), '8214100099');
        $this->assertSame($prestador->getNomeFantasia(), 'Empresa Teste');
        $this->assertSame($prestador->getRazaoSocial(), 'Empresa Teste LTDA');
        $this->assertSame($prestador->getRegimeTributario(), 0);
        $this->assertSame($prestador->getRegimeTributarioEspecial(), 0);
        $this->assertSame($prestador->getSimplesNacional(), 0);
        $this->assertSame($prestador->getTelefone()->getDdd(), '44');
        $this->assertSame($prestador->getTelefone()->getNumero(), '12341234');
    }
}
