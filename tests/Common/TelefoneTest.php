<?php

namespace TecnoSpeed\Plugnotas\Tests\Common;

use PHPUnit\Framework\TestCase;
use TecnoSpeed\Plugnotas\Common\Telefone;
use TecnoSpeed\Plugnotas\Error\InvalidTypeError;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class TelefoneTest extends TestCase
{
    /**
     * @covers TecnoSpeed\Plugnotas\Common\Telefone::setDdd
     */
    public function testEmptyDDD()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('DDD inválido.');
        $telefone = new Telefone();
        $telefone->setDdd(null);
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\Telefone::setDdd
     */
    public function testInvalidDDD()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('DDD inválido.');
        $telefone = new Telefone();
        $telefone->setDdd('123');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\Telefone::setNumero
     */
    public function testEmptyNumber()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Número inválido.');
        $telefone = new Telefone();
        $telefone->setNumero(null);
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\Telefone::setNumero
     */
    public function testInvalidNumber()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Número inválido.');
        $telefone = new Telefone();
        $telefone->setNumero('1234567890');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\Telefone::getDdd
     * @covers TecnoSpeed\Plugnotas\Common\Telefone::setDdd
     */
    public function testDddWithTraillingZero()
    {
        $telefone = new Telefone();
        $telefone->setDdd('044');
        $this->assertSame($telefone->getDdd(), '44');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\Telefone::getNumero
     * @covers TecnoSpeed\Plugnotas\Common\Telefone::setNumero
     */
    public function testNumberWithTraillingZero()
    {
        $telefone = new Telefone();
        $telefone->setNumero('01234-1234');
        $this->assertSame($telefone->getNumero(), '12341234');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\Telefone::getNumero
     */
    public function testNumberWithNineCharacter()
    {
        $telefone = new Telefone();
        $telefone->setNumero('91234-1234');
        $this->assertSame($telefone->getNumero(), '912341234');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\Telefone::getNumero
     */
    public function testNumberWithEightCharacter()
    {
        $telefone = new Telefone();
        $telefone->setNumero('1234-1234');
        $this->assertSame($telefone->getNumero(), '12341234');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\Telefone::getDdd
     * @covers TecnoSpeed\Plugnotas\Common\Telefone::getNumero
     */
    public function testConstructorWithValidNumber()
    {
        $telefone = new Telefone('44', '1234-1234');
        $this->assertSame($telefone->getDdd(), '44');
        $this->assertSame($telefone->getNumero(), '12341234');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\Telefone::__construct
     */
    public function testConstructorWithInvalidDdd()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('DDD inválido.');
        $telefone = new Telefone('123', '1234-1234');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\Telefone::__construct
     */
    public function testConstructorWithInvalidNumber()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Número inválido.');
        $telefone = new Telefone('44', '1234567890');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\Telefone::fromArray
     */
    public function testWithInvalidNumberFromArray()
    {
        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Número inválido.');
        $telefone = Telefone::fromArray([
            'ddd' => '44',
            'numero' => '1234567890'
        ]);
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\Telefone::fromArray
     */
    public function testWithNoArrayFromArray()
    {
        $this->expectException(InvalidTypeError::class);
        $this->expectExceptionMessage('Deve ser informado um array.');
        $telefone = Telefone::fromArray('44 1234-1234');
    }

    /**
     * @covers TecnoSpeed\Plugnotas\Common\Telefone::fromArray
     */
    public function testWithValidArray()
    {
        $telefone = Telefone::fromArray([
            'ddd' => '44',
            'numero' => '1234-1234'
        ]);
        $this->assertSame(get_class($telefone), Telefone::class);
        $this->assertSame($telefone->getNumero(), '12341234');
        $this->assertSame($telefone->getDdd(), '44');
    }
}
