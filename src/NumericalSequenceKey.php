<?php
namespace HylianShield\KeyGenerator;

class NumericalSequenceKey implements NumericalSequenceKeyInterface
{
    /** @var int[] */
    private $sequence;

    /**
     * Constructor.
     *
     * @param int[] ...$sequence
     */
    public function __construct(int ...$sequence)
    {
        $this->sequence = $sequence;
    }

    /**
     * Get the numerical sequence.
     *
     * @return int[]
     */
    public function getNumericalSequence(): array
    {
        return $this->sequence;
    }
}
