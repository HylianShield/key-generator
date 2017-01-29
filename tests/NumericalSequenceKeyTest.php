<?php
/**
 * Copyright MediaCT. All rights reserved.
 * https://www.mediact.nl
 */

namespace HylianShield\KeyGenerator\Tests;

use HylianShield\KeyGenerator\NumericalSequenceKey;

/**
 * @coversDefaultClass \HylianShield\KeyGenerator\NumericalSequenceKey
 */
class NumericalSequenceKeyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return NumericalSequenceKey
     * @covers ::__construct
     */
    public function testConstructor(): NumericalSequenceKey
    {
        return new NumericalSequenceKey(1, 2, 3, 4);
    }

    /**
     * @depends testConstructor
     *
     * @param NumericalSequenceKey $key
     *
     * @return int[]
     * @covers ::getNumericalSequence
     */
    public function testGetNumericalSequence(NumericalSequenceKey $key): array
    {
        return $key->getNumericalSequence();
    }
}
