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

/**
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class BlankValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof Blank) {
            throw new UnexpectedTypeException($constraint, Blank::class);
        }

        if ('' !== $value && null !== $value) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->setCode(Blank::NOT_BLANK_ERROR)
                ->addViolation();
        }
    }
}
