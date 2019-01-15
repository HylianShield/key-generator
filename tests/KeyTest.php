<?php
/**
 * Copyright MediaCT. All rights reserved.
 * https://www.mediact.nl
 */

namespace HylianShield\KeyGenerator\Tests;

use HylianShield\KeyGenerator\Key;
use HylianShield\KeyGenerator\NumericalSequenceKey;
use HylianShield\KeyGenerator\NumericalSequenceKeyInterface;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \HylianShield\KeyGenerator\Key
 */
class KeyTest extends TestCase
{
    /**
     * @return Key
     * @covers ::__construct
     */
    public function testConstructor(): Key
    {
        $key = new Key(
            'foo',
            new NumericalSequenceKey(1, 2, 3, 4)
        );

        $this->assertInstanceOf(Key::class, $key);

        return $key;
    }

    /**
     * @depends testConstructor
     *
     * @param Key $key
     *
     * @return void
     * @covers ::__toString
     */
    public function testToString(Key $key)
    {
        $this->assertSame('foo', (string) $key);
    }

    /**
     * @depends testConstructor
     *
     * @param Key $key
     *
     * @return void
     * @covers ::getNumericalSequence
     */
    public function testGetNumericalSequence(Key $key)
    {
        $this->assertSame([1, 2, 3, 4], $key->getNumericalSequence());
    }
}
