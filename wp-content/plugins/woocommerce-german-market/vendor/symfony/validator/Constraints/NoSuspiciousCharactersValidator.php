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
use MarketPress\German_Market\Symfony\Component\Validator\Exception\LogicException;
use MarketPress\German_Market\Symfony\Component\Validator\Exception\UnexpectedTypeException;
use MarketPress\German_Market\Symfony\Component\Validator\Exception\UnexpectedValueException;

/**
 * @author Mathieu Lechat <math.lechat@gmail.com>
 */
class NoSuspiciousCharactersValidator extends ConstraintValidator
{
    private const CHECK_RESTRICTION_LEVEL = 16;
    private const CHECK_SINGLE_SCRIPT = 16;
    private const CHECK_CHAR_LIMIT = 64;

    private const CHECK_ERROR = [
        self::CHECK_RESTRICTION_LEVEL => [
            'code' => NoSuspiciousCharacters::RESTRICTION_LEVEL_ERROR,
            'messageProperty' => 'restrictionLevelMessage',
        ],
        NoSuspiciousCharacters::CHECK_INVISIBLE => [
            'code' => NoSuspiciousCharacters::INVISIBLE_ERROR,
            'messageProperty' => 'invisibleMessage',
        ],
        self::CHECK_CHAR_LIMIT => [
            'code' => NoSuspiciousCharacters::RESTRICTION_LEVEL_ERROR,
            'messageProperty' => 'restrictionLevelMessage',
        ],
        NoSuspiciousCharacters::CHECK_MIXED_NUMBERS => [
            'code' => NoSuspiciousCharacters::MIXED_NUMBERS_ERROR,
            'messageProperty' => 'mixedNumbersMessage',
        ],
        NoSuspiciousCharacters::CHECK_HIDDEN_OVERLAY => [
            'code' => NoSuspiciousCharacters::HIDDEN_OVERLAY_ERROR,
            'messageProperty' => 'hiddenOverlayMessage',
        ],
    ];

    /**
     * @param string[] $defaultLocales
     */
    public function __construct(private readonly array $defaultLocales = [])
    {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof NoSuspiciousCharacters) {
            throw new UnexpectedTypeException($constraint, NoSuspiciousCharacters::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!\is_scalar($value) && !$value instanceof \Stringable) {
            throw new UnexpectedValueException($value, 'string');
        }

        if ('' === $value = (string) $value) {
            return;
        }

        $checker = new \Spoofchecker();
        $checks = $constraint->checks;

        if (method_exists($checker, 'setRestrictionLevel')) {
            $checks |= self::CHECK_RESTRICTION_LEVEL;
            $checker->setRestrictionLevel($constraint->restrictionLevel ?? NoSuspiciousCharacters::RESTRICTION_LEVEL_MODERATE);
        } elseif (NoSuspiciousCharacters::RESTRICTION_LEVEL_MINIMAL === $constraint->restrictionLevel) {
            $checks |= self::CHECK_CHAR_LIMIT;
        } elseif (NoSuspiciousCharacters::RESTRICTION_LEVEL_SINGLE_SCRIPT === $constraint->restrictionLevel) {
            $checks |= self::CHECK_SINGLE_SCRIPT | self::CHECK_CHAR_LIMIT;
        } elseif ($constraint->restrictionLevel) {
            throw new LogicException('You can only use one of RESTRICTION_LEVEL_NONE, RESTRICTION_LEVEL_MINIMAL or RESTRICTION_LEVEL_SINGLE_SCRIPT with intl compiled against ICU < 58.');
        } else {
            $checks |= self::CHECK_SINGLE_SCRIPT;
        }

        $checker->setAllowedLocales(implode(',', $constraint->locales ?? $this->defaultLocales));

        $checker->setChecks($checks);

        if (!$checker->isSuspicious($value, $errorCode)) {
            return;
        }

        foreach (self::CHECK_ERROR as $check => $error) {
            if (!($errorCode & $check)) {
                continue;
            }

            $this->context->buildViolation($constraint->{$error['messageProperty']})
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->setCode($error['code'])
                ->addViolation()
            ;
        }
    }
}
