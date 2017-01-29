<?php
namespace HylianShield\KeyGenerator;

interface NumericalSequenceKeyInterface
{
    /**
     * Get the numerical sequence.
     *
     * @return int[]
     */
    public function getNumericalSequence(): array;
}
