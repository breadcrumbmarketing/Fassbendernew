<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\Symfony\Component\Validator\Constraints;

use MarketPress\German_Market\Symfony\Component\Validator\Constraint;
use MarketPress\German_Market\Symfony\Component\Validator\ConstraintValidator;
use MarketPress\German_Market\Symfony\Component\Validator\Exception\UnexpectedTypeException;
use MarketPress\German_Market\Symfony\Component\Validator\Exception\UnexpectedValueException;

/**
 * Validates a PAN using the LUHN Algorithm.
 *
 * For a list of example card numbers that are used to test this
 * class, please see the LuhnValidatorTest class.
 *
 * @see    http://en.wikipedia.org/wiki/Luhn_algorithm
 *
 * @author Tim Nagel <t.nagel@infinite.net.au>
 * @author Greg Knapp http://gregk.me/2011/php-implementation-of-bank-card-luhn-algorithm/
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class LuhnValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof Luhn) {
            throw new UnexpectedTypeException($constraint, Luhn::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        // Work with strings only, because long numbers are represented as floats
        // internally and don't work with strlen()
        if (!\is_string($value) && !$value instanceof \Stringable) {
            throw new UnexpectedValueException($value, 'string');
        }

        $value = (string) $value;

        if (!ctype_digit($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->setCode(Luhn::INVALID_CHARACTERS_ERROR)
                ->addViolation();

            return;
        }

        $checkSum = 0;
        $length = \strlen($value);

        for ($i = $length - 1; $i >= 0; --$i) {
            if (($i % 2) ^ ($length % 2)) {
                // Starting with the last digit and walking left, add every second
                // digit to the check sum
                // e.g. 7  9  9  2  7  3  9  8  7  1  3
                //      ^     ^     ^     ^     ^     ^
                //    = 7  +  9  +  7  +  9  +  7  +  3
                $checkSum += (int) $value[$i];
            } else {
                // Starting with the second last digit and walking left, double every
                // second digit and add it to the check sum
                // For doubles greater than 9, sum the individual digits
                // e.g. 7  9  9  2  7  3  9  8  7  1  3
                //         ^     ^     ^     ^     ^
                //    =    1+8 + 4  +  6  +  1+6 + 2
                $checkSum += (((int) (2 * $value[$i] / 10)) + (2 * $value[$i]) % 10);
            }
        }

        if (0 === $checkSum || 0 !== $checkSum % 10) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->setCode(Luhn::CHECKSUM_FAILED_ERROR)
                ->addViolation();
        }
    }
}
