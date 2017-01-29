<?php
/**
 * Copyright MediaCT. All rights reserved.
 * https://www.mediact.nl
 */

namespace HylianShield\KeyGenerator\Tests;

use HylianShield\Encoding\Base32CrockfordEncoder;
use HylianShield\KeyGenerator\KeyGenerator;
use HylianShield\KeyGenerator\KeyInterface;
use HylianShield\KeyGenerator\NumericalSequenceKeyInterface;
use HylianShield\NumberGenerator\NumberGeneratorInterface;
use Iterator;

/**
 * @coversDefaultClass \HylianShield\KeyGenerator\KeyGenerator
 */
class KeyGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return KeyGenerator
     * @covers ::__construct
     */
    public function testConstructor(): KeyGenerator
    {
        $generator = $this->createMock(NumberGeneratorInterface::class);

        // Mock the yield behavior by returning an iterator.
        $generator
            ->expects($this->any())
            ->method('generateList')
            ->willReturn($this->createMock(Iterator::class));

        return new KeyGenerator(
            $generator,
            $this->createMock(Base32CrockfordEncoder::class)
        );
    }

    /**
     * @depends testConstructor
     *
     * @param KeyGenerator $generator
     *
     * @return KeyInterface
     * @covers ::generateKey
     */
    public function testGenerateKey(KeyGenerator $generator): KeyInterface
    {
        return $generator->generateKey();
    }

    /**
     * @depends testConstructor
     *
     * @param KeyGenerator $generator
     *
     * @return KeyInterface
     * @covers ::encode
     */
    public function testEncode(KeyGenerator $generator): KeyInterface
    {
        return $generator->encode(
            $this->createMock(NumericalSequenceKeyInterface::class)
        );
    }

    /**
     * @depends testConstructor
     *
     * @param KeyGenerator $generator
     *
     * @return NumericalSequenceKeyInterface
     * @covers ::decode
     */
    public function testDecode(
        KeyGenerator $generator
    ): NumericalSequenceKeyInterface {
        return $generator->decode(
            $this->createMock(KeyInterface::class)
        );
    }
}
