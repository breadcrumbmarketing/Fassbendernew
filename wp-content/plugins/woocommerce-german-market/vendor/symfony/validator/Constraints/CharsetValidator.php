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
 * @author Alexandre Daubois <alex.daubois@gmail.com>
 */
final class CharsetValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof Charset) {
            throw new UnexpectedTypeException($constraint, Charset::class);
        }

        if (null === $value) {
            return;
        }

        if (!\is_string($value) && !$value instanceof \Stringable) {
            throw new UnexpectedValueException($value, 'string');
        }

        if (!\in_array(mb_detect_encoding($value, $constraint->encodings, true), (array) $constraint->encodings, true)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ detected }}', mb_detect_encoding($value, strict: true))
                ->setParameter('{{ encodings }}', implode(', ', (array) $constraint->encodings))
                ->setCode(Charset::BAD_ENCODING_ERROR)
                ->addViolation();
        }
    }
}
