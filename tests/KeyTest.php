<?php
/**
 * Copyright MediaCT. All rights reserved.
 * https://www.mediact.nl
 */

namespace HylianShield\KeyGenerator\Tests;

use HylianShield\KeyGenerator\Key;
use HylianShield\KeyGenerator\NumericalSequenceKeyInterface;

/**
 * @coversDefaultClass \HylianShield\KeyGenerator\Key
 */
class KeyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return Key
     * @covers ::__construct
     */
    public function testConstructor(): Key
    {
        return new Key(
            'foo',
            $this->createMock(NumericalSequenceKeyInterface::class)
        );
    }

    /**
     * @depends testConstructor
     *
     * @param Key $key
     *
     * @return string
     * @covers ::__toString
     */
    public function testToString(Key $key): string
    {
        return $key->__toString();
    }

    /**
     * @depends testConstructor
     *
     * @param Key $key
     *
     * @return int[]
     * @covers ::getNumericalSequence
     */
    public function testGetNumericalSequence(Key $key): array
    {
        return $key->getNumericalSequence();
    }
}
