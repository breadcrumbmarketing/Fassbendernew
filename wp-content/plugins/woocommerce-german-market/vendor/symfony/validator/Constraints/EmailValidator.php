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

use Egulias\EmailValidator\EmailValidator as EguliasEmailValidator;
use Egulias\EmailValidator\Validation\EmailValidation;
use Egulias\EmailValidator\Validation\NoRFCWarningsValidation;
use MarketPress\German_Market\Symfony\Component\Validator\Constraint;
use MarketPress\German_Market\Symfony\Component\Validator\ConstraintValidator;
use MarketPress\German_Market\Symfony\Component\Validator\Exception\InvalidArgumentException;
use MarketPress\German_Market\Symfony\Component\Validator\Exception\LogicException;
use MarketPress\German_Market\Symfony\Component\Validator\Exception\UnexpectedTypeException;
use MarketPress\German_Market\Symfony\Component\Validator\Exception\UnexpectedValueException;

/**
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class EmailValidator extends ConstraintValidator
{
    private const PATTERN_HTML5_ALLOW_NO_TLD = '/^[a-zA-Z0-9.!#$%&\'*+\\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/D';
    private const PATTERN_HTML5 = '/^[a-zA-Z0-9.!#$%&\'*+\\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$/D';

    private const EMAIL_PATTERNS = [
        Email::VALIDATION_MODE_HTML5 => self::PATTERN_HTML5,
        Email::VALIDATION_MODE_HTML5_ALLOW_NO_TLD => self::PATTERN_HTML5_ALLOW_NO_TLD,
    ];

    private string $defaultMode;

    public function __construct(string $defaultMode = Email::VALIDATION_MODE_HTML5)
    {
        if (!\in_array($defaultMode, Email::VALIDATION_MODES, true)) {
            throw new InvalidArgumentException('The "defaultMode" parameter value is not valid.');
        }

        $this->defaultMode = $defaultMode;
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof Email) {
            throw new UnexpectedTypeException($constraint, Email::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!\is_scalar($value) && !$value instanceof \Stringable) {
            throw new UnexpectedValueException($value, 'string');
        }

        $value = (string) $value;
        if ('' === $value) {
            return;
        }

        if (null !== $constraint->normalizer) {
            $value = ($constraint->normalizer)($value);
        }

        if (null === $constraint->mode) {
            if (Email::VALIDATION_MODE_STRICT === $this->defaultMode && !class_exists(EguliasEmailValidator::class)) {
                throw new LogicException(sprintf('The "egulias/email-validator" component is required to make the "%s" constraint default to strict mode. Try running "composer require egulias/email-validator".', Email::class));
            }

            $constraint->mode = $this->defaultMode;
        }

        if (!\in_array($constraint->mode, Email::VALIDATION_MODES, true)) {
            throw new InvalidArgumentException(sprintf('The "%s::$mode" parameter value is not valid.', get_debug_type($constraint)));
        }

        if (Email::VALIDATION_MODE_STRICT === $constraint->mode) {
            $strictValidator = new EguliasEmailValidator();

            if (interface_exists(EmailValidation::class) && !$strictValidator->isValid($value, new NoRFCWarningsValidation())) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ value }}', $this->formatValue($value))
                    ->setCode(Email::INVALID_FORMAT_ERROR)
                    ->addViolation();

                return;
            } elseif (!interface_exists(EmailValidation::class) && !$strictValidator->isValid($value, false, true)) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ value }}', $this->formatValue($value))
                    ->setCode(Email::INVALID_FORMAT_ERROR)
                    ->addViolation();

                return;
            }
        } elseif (!preg_match(self::EMAIL_PATTERNS[$constraint->mode], $value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->setCode(Email::INVALID_FORMAT_ERROR)
                ->addViolation();

            return;
        }
    }
}
