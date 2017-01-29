<?php
namespace HylianShield\KeyGenerator;

use HylianShield\Encoding\Base32CrockfordEncoder;
use HylianShield\NumberGenerator\NumberGeneratorInterface;

class KeyGenerator implements
    KeyGeneratorInterface,
    KeyEncoderInterface,
    KeyDecoderInterface
{
    const PARTITION_SYMBOL = Base32CrockfordEncoder::PARTITION_SYMBOL;
    const MIN = 34359738368;   // '10000000'
    const MAX = 1099511627775; // 'ZZZZZZZZ'

    /** @var NumberGeneratorInterface */
    private $generator;

    /** @var Base32CrockfordEncoder */
    private $encoder;

    /**
     * Constructor.
     *
     * @param NumberGeneratorInterface $generator
     * @param Base32CrockfordEncoder   $encoder
     */
    public function __construct(
        NumberGeneratorInterface $generator,
        Base32CrockfordEncoder $encoder
    ) {
        $this->generator = $generator;
        $this->encoder   = $encoder;
    }

    /**
     * Decode the given key into a numerical sequence.
     *
     * @param KeyInterface $key
     *
     * @return NumericalSequenceKeyInterface
     */
    public function decode(KeyInterface $key): NumericalSequenceKeyInterface
    {
        return new NumericalSequenceKey(
            ...array_map(
                function (string $group) : int {
                    return $this->encoder->decode($group);
                },
                explode(static::PARTITION_SYMBOL, (string)$key)
            )
        );
    }

    /**
     * Encode the given sequence into a key.
     *
     * @param NumericalSequenceKeyInterface $sequence
     *
     * @return KeyInterface
     */
    public function encode(
        NumericalSequenceKeyInterface $sequence
    ): KeyInterface {
        return new Key(
            implode(
                static::PARTITION_SYMBOL,
                array_map(
                    function (int $number) : string {
                        return substr(
                            $this->encoder->encode($number),
                            0,
                            Base32CrockfordEncoder::GROUP_SIZE
                        );
                    },
                    $sequence->getNumericalSequence()
                )
            )
        );
    }

    /**
     * Generate a key for the given number of groups.
     *
     * @param int $numGroups
     *
     * @return KeyInterface
     */
    public function generateKey(int $numGroups = 5): KeyInterface
    {
        /** @noinspection PhpParamsInspection */
        /** @noinspection PhpVoidFunctionResultUsedInspection */
        $sequence = new NumericalSequenceKey(
            ...iterator_to_array(
                $this
                    ->generator
                    ->generateList($numGroups, static::MIN, static::MAX)
            )
        );

        return $this->encode($sequence);
    }
}
