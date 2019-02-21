<?php

namespace TecnoSpeed\Plugnotas\Tests\Nfse;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Common\Endereco;
use TecnoSpeed\Plugnotas\Common\Telefone;
use TecnoSpeed\Plugnotas\Error\InvalidTypeError;
use TecnoSpeed\Plugnotas\Error\ValidationError;
use TecnoSpeed\Plugnotas\Nfse\Tomador;

class TomadorTest extends TestCase
{
    public function testWithInvalidLengthCpfCnpj()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Campo cpfCnpj deve ter 11 ou 14 números.');
        $tomador = new Tomador();
        $tomador->setCpfCnpj('12345678901234567890');
    }

    public function testWithInvalidCpfFormation()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('CPF inválido.');
        $tomador = new Tomador();
        $tomador->setCpfCnpj('123.456.789-01');
    }

    public function testWithInvalidCnpjFormation()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('CNPJ inválido.');
        $tomador = new Tomador();
        $tomador->setCpfCnpj('12.345.678/0001-90');
    }

    public function testWithNullRazaoSocial()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Razão social é requerida para NFSe.');
        $tomador = new Tomador();
        $tomador->setRazaoSocial(null);
    }

    public function testWithInvalidEmail()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Endereço de email inválido.');
        $tomador = new Tomador();
        $tomador->setEmail('teste');
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

        $tomador = new Tomador();
        $tomador->setCpfCnpj('00.000.000/0001-91');
        $tomador->setEmail('teste@plugnotas.com.br');
        $tomador->setEndereco($endereco);
        $tomador->setInscricaoEstadual('8214100099');
        $tomador->setNomeFantasia('Empresa Teste');
        $tomador->setRazaoSocial('Empresa Teste LTDA');
        $tomador->setTelefone($telefone);

        $this->assertSame($tomador->getCpfCnpj(), '00000000000191');
        $this->assertSame($tomador->getEmail(), 'teste@plugnotas.com.br');
        $this->assertSame($tomador->getEndereco()->getCep(), '87020025');
        $this->assertSame($tomador->getInscricaoEstadual(), '8214100099');
        $this->assertSame($tomador->getNomeFantasia(), 'Empresa Teste');
        $this->assertSame($tomador->getRazaoSocial(), 'Empresa Teste LTDA');
        $this->assertSame($tomador->getTelefone()->getDdd(), '44');
        $this->assertSame($tomador->getTelefone()->getNumero(), '12341234');
    }

    public function testBuildFromArray()
    {
        $data = ['cpfCnpj' => '00.000.000/0001-91'];
        $tomador = Tomador::fromArray($data);
        $this->assertInstanceOf(Tomador::class, $tomador);
        $this->assertSame($tomador->getCpfCnpj(), '00000000000191');
    }

    public function testBuildFromArrayWithEnderecoAndTelefone()
    {
        $data = [
            'cpfCnpj' => '00.000.000/0001-91',
            'telefone' => [
                'ddd' => '44',
                'numero' => '12341234'
            ],
            'endereco' => [
                'logradouro' => 'Rua de teste'
            ]
        ];
        $tomador = Tomador::fromArray($data);
        $this->assertInstanceOf(Tomador::class, $tomador);
        $this->assertSame($tomador->getCpfCnpj(), '00000000000191');
        $this->assertInstanceOf(Endereco::class, $tomador->getEndereco());
        $this->assertInstanceOf(Telefone::class, $tomador->getTelefone());
    }

    public function testBuildFromArrayWithInvalidParameter()
    {
        $this->expectException(InvalidTypeError::class);
        $this->expectExceptionMessage('Deve ser informado um array.');
        $tomador = Tomador::fromArray('teste');
    }
}
