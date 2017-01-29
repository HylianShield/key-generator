<?php
namespace HylianShield\KeyGenerator;

interface KeyDecoderInterface
{
    /**
     * Decode the given key into a numerical sequence.
     *
     * @param KeyInterface $key
     *
     * @return NumericalSequenceKeyInterface
     */
    public function decode(KeyInterface $key): NumericalSequenceKeyInterface;
}
