# Introduction

Generate, encode and decode serials and API keys.

# Installation

```shell
composer require hylianshield/key-generator:^1.0.0
```

# Command line

| Command            | Alias                   | Usage                                | Description                                             |
|:-------------------|:------------------------|:-------------------------------------|:--------------------------------------------------------|
| `bin/generate-key` | `composer generate-key` | `generate-key [<num-groups>]`        | Generate an API key with the supplied number of groups. |
| `bin/encode-key`   | `composer encode-key`   | `encode-key <number>[, ...<number>]` | Encode a key for the given list of numbers.             |
| `bin/decode-key`   | `composer decode-key`   | `decode-key <key>`                   | Decode the given key into a numerical sequence.         |

To see a complete result of the described functionality, try the following:

```shell
composer encode-key $(composer decode-key $(composer generate-key))
```

The output will be similar to:

```
> ./bin/generate-key
> ./bin/decode-key 'EF0M508N-FZ78BSC1-GJRJKQTG-K01FGZ7Z-KQK2F81H'
> ./bin/encode-key '497163600149' '548925728129' '569907994448' '652884868351' '678171222065'
EF0M508N-FZ78BSC1-GJRJKQTG-K01FGZ7Z-KQK2F81H
```

# Usage

```php
<?php
use HylianShield\KeyGenerator\Key;
use HylianShield\KeyGenerator\NumericalSequenceKey;
use HylianShield\KeyGenerator\KeyGenerator;
use HylianShield\NumberGenerator\NumberGenerator;
use HylianShield\Encoding\Base32CrockfordEncoder;

$generator = new KeyGenerator(
    new NumberGenerator(),
    new Base32CrockfordEncoder()
);

// Keys can be interpreted as string.
echo $generator->generateKey(3); // 'HR0ZCHTF-TSDMKNRX-HQK5EJZQ'

// Keys can be decoded back to a numerical sequence.
$sequence = $generator->decode(
    new Key('HR0ZCHTF-TSDMKNRX-HQK5EJZQ')
);

// And keys can be encoded from a numerical sequence.
$key = $generator->encode(
    new NumericalSequenceKey(609918273359, 920654567197, 609454869495)    
);

// Key output will be the same for any given numerical sequence.
echo $key;                                       // 'HR0ZCHTF-TSDMKNRX-HQK5EJZQ'
echo implode(' ', $key->getNumericalSequence()); // '609918273359 920654567197 609454869495'
```

Note that when encoding or generating a key, the numerical sequence will be
stored in the key object.
When a key is created manually, by supplying a string, the key will not be
automatically decoded into a numerical sequence.
This is to improve performance.

# Security

The numbers are generated using an implementation of a
[number generator](https://github.com/HylianShield/number-generator).
By default, it generates numbers using the
[CSPRNG](http://php.net/manual/en/book.csprng.php)
implementation introduced in PHP 7.

For more control over key generation, try implementing a custom number generator.

```php
<?php
use HylianShield\KeyGenerator\KeyGenerator;
use HylianShield\NumberGenerator\NumberGenerator;
use HylianShield\Encoding\Base32CrockfordEncoder;

$generator = new KeyGenerator(
    new class extends NumberGenerator
    {
        public function generateNumber(int $min = 0, int $max = PHP_INT_MAX): int
        {
            // Do not actually use this implementation.
            // It is there for example purposes only.
            return mt_rand($min, $max);
        }
    },
    new Base32CrockfordEncoder()
);
```

For specific and fine-grained control, create a custom number sequence and let
that be encoded.

```php
<?php
use HylianShield\KeyGenerator\NumericalSequenceKey;

/** HylianShield\KeyGenerator\KeyEncoderInterface $encoder */
$key = $encoder->encode(
    new NumericalSequenceKey(1, 2, 3, 4, 5)
);
```
