<?php
namespace HylianShield\KeyGenerator;

class Key implements KeyInterface
{
    /** @var string */
    private $key;

    /** @var NumericalSequenceKeyInterface */
    private $sequence;

    /**
     * Constructor.
     *
     * @param string                        $key
     * @param NumericalSequenceKeyInterface $sequence
     */
    public function __construct(
        $key,
        NumericalSequenceKeyInterface $sequence = null
    ) {
        $this->key      = $key;
        $this->sequence = $sequence;
    }

    /**
     * Get the encoded representation of the key.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->key;
    }

    /**
     * Get the numerical sequence.
     *
     * @return int[]
     */
    public function getNumericalSequence(): array
    {
        return $this->sequence->getNumericalSequence();
    }
}
