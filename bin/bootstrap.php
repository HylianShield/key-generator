<?php
require_once __DIR__ . '/../vendor/autoload.php';

use HylianShield\KeyGenerator\KeyGenerator;
use HylianShield\NumberGenerator\NumberGenerator;
use HylianShield\Encoding\Base32CrockfordEncoder;

return new KeyGenerator(
    new NumberGenerator(),
    new Base32CrockfordEncoder()
);
