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
 * @author Imad ZAIRIG <imadzairig@gmail.com>
 */
class JsonValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof Json) {
            throw new UnexpectedTypeException($constraint, Json::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!\is_scalar($value) && !$value instanceof \Stringable) {
            throw new UnexpectedValueException($value, 'string');
        }

        $value = (string) $value;

        if (!json_validate($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->setCode(Json::INVALID_JSON_ERROR)
                ->addViolation();
        }
    }
}
