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
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class TimeValidator extends ConstraintValidator
{
    public const PATTERN = '/^(\d{2}):(\d{2}):(\d{2})$/D';
    public const PATTERN_WITHOUT_SECONDS = '/^(\d{2}):(\d{2})$/D';

    /**
     * Checks whether a time is valid.
     *
     * @internal
     */
    public static function checkTime(int $hour, int $minute, float $second): bool
    {
        return $hour >= 0 && $hour < 24 && $minute >= 0 && $minute < 60 && $second >= 0 && $second < 60;
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof Time) {
            throw new UnexpectedTypeException($constraint, Time::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!\is_scalar($value) && !$value instanceof \Stringable) {
            throw new UnexpectedValueException($value, 'string');
        }

        $value = (string) $value;

        if (!preg_match($constraint->withSeconds ? static::PATTERN : static::PATTERN_WITHOUT_SECONDS, $value, $matches)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->setCode(Time::INVALID_FORMAT_ERROR)
                ->addViolation();

            return;
        }

        if (!self::checkTime($matches[1], $matches[2], $constraint->withSeconds ? $matches[3] : 0)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->setCode(Time::INVALID_TIME_ERROR)
                ->addViolation();
        }
    }
}
