<?php
namespace HylianShield\KeyGenerator;

interface KeyEncoderInterface
{
    /**
     * Encode the given sequence into a key.
     *
     * @param NumericalSequenceKeyInterface $sequence
     *
     * @return KeyInterface
     */
    public function encode(
        NumericalSequenceKeyInterface $sequence
    ): KeyInterface;
}
