<?php
/**
 * Copyright MediaCT. All rights reserved.
 * https://www.mediact.nl
 */

namespace HylianShield\KeyGenerator\Tests;

use HylianShield\KeyGenerator\NumericalSequenceKey;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \HylianShield\KeyGenerator\NumericalSequenceKey
 */
class NumericalSequenceKeyTest extends TestCase
{
    /**
     * @return NumericalSequenceKey
     * @covers ::__construct
     */
    public function testConstructor(): NumericalSequenceKey
    {
        $key = new NumericalSequenceKey(1, 2, 3, 4);

        $this->assertInstanceOf(NumericalSequenceKey::class, $key);

        return $key;
    }

    /**
     * @depends testConstructor
     *
     * @param NumericalSequenceKey $key
     *
     * @return void
     * @covers ::getNumericalSequence
     */
    public function testGetNumericalSequence(NumericalSequenceKey $key)
    {
        $sequences = $key->getNumericalSequence();

        $this->assertCount(4, $sequences);
        $this->assertSame([1, 2, 3, 4], $sequences);
    }
}
