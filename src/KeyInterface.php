<?php
/**
 * Copyright MediaCT. All rights reserved.
 * https://www.mediact.nl
 */

namespace HylianShield\KeyGenerator;

interface KeyInterface extends NumericalSequenceKeyInterface
{
    /**
     * Get the encoded representation of the key.
     *
     * @return string
     */
    public function __toString(): string;
}
