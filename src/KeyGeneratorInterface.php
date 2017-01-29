<?php
namespace HylianShield\KeyGenerator;

interface KeyGeneratorInterface
{
    /**
     * Generate a key for the given number of groups.
     *
     * @param int $numGroups
     *
     * @return KeyInterface
     */
    public function generateKey(int $numGroups = 5): KeyInterface;
}
