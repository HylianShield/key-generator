<?php
/**
 * Copyright MediaCT. All rights reserved.
 * https://www.mediact.nl
 */

namespace HylianShield\KeyGenerator\Tests;

use HylianShield\Encoding\Base32CrockfordEncoder;
use HylianShield\KeyGenerator\Key;
use HylianShield\KeyGenerator\KeyGenerator;
use HylianShield\KeyGenerator\KeyInterface;
use HylianShield\KeyGenerator\NumericalSequenceKeyInterface;
use HylianShield\KeyGenerator\NumericalSequenceKey;
use HylianShield\NumberGenerator\NumberGenerator;
use HylianShield\NumberGenerator\NumberGeneratorInterface;
use PHPUnit\Framework\TestCase;
use Iterator;

/**
 * @coversDefaultClass \HylianShield\KeyGenerator\KeyGenerator
 */
class KeyGeneratorTest extends TestCase
{
    /**
     * @return KeyGenerator
     * @covers ::__construct
     */
    public function testConstructor(): KeyGenerator
    {
        $generator = new NumberGenerator();
        $generator->generateList(1, 2, 3, 4);

        $encoder = new Base32CrockfordEncoder();

        $keyGenerator = new KeyGenerator(
            $generator,
            $encoder
        );

        $this->assertInstanceOf(KeyGenerator::class, $keyGenerator);

        return $keyGenerator;
    }

    /**
     * @depends testConstructor
     *
     * @param KeyGenerator $generator
     *
     * @return void
     * @covers ::generateKey
     */
    public function testGenerateKey(KeyGenerator $generator)
    {
        $key = $generator->generateKey();

        $this->assertRegExp('/[A-Z . \d]{8,8}-[A-Z . \d]{8,8}-[A-Z . \d]{8,8}-[A-Z . \d]{8,8}-[A-Z . \d]{8,8}/', (string) $key);
    }

    /**
     * @depends testConstructor
     *
     * @param KeyGenerator $generator
     *
     * @return void
     * @covers ::encode
     */
    public function testEncode(KeyGenerator $generator)
    {
        $encodedResult = $generator->encode(
            new NumericalSequenceKey(1, 2, 3, 4)
        );

        $this->assertInstanceOf(Key::class, $encodedResult);
        $this->assertSame('00000001-00000002-00000003-00000004', (string) $encodedResult);
    }

    /**
     * @depends testConstructor
     *
     * @param KeyGenerator $generator
     *
     * @return void
     * @covers ::decode
     */
    public function testDecode(KeyGenerator $generator)
    {
        $key = new Key(
            '00000001-00000002-00000003-00000004',
            new NumericalSequenceKey(1, 2, 3, 4)
        );

        $decodedResult = $generator->decode($key);

        $this->assertInstanceOf(NumericalSequenceKey::class, $decodedResult);
        $this->assertSame([1, 2, 3, 4], $decodedResult->getNumericalSequence());
    }
}
