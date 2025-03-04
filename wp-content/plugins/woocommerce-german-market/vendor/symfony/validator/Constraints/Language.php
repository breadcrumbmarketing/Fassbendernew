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

use Symfony\Component\Intl\Languages;
use MarketPress\German_Market\Symfony\Component\Validator\Constraint;
use MarketPress\German_Market\Symfony\Component\Validator\Exception\LogicException;

/**
 * Validates that a value is a valid language Unicode language identifier.
 *
 * @see https://unicode.org/reports/tr35/#Unicode_language_identifier
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Language extends Constraint
{
    public const NO_SUCH_LANGUAGE_ERROR = 'ee65fec4-9a20-4202-9f39-ca558cd7bdf7';

    protected const ERROR_NAMES = [
        self::NO_SUCH_LANGUAGE_ERROR => 'NO_SUCH_LANGUAGE_ERROR',
    ];

    public string $message = 'This value is not a valid language.';
    public bool $alpha3 = false;

    /**
     * @param array<string,mixed>|null $options
     * @param bool|null                $alpha3  Pass true to validate the language with three-letter code (ISO 639-2 (2T)) or false with two-letter code (ISO 639-1) (defaults to false)
     * @param string[]|null            $groups
     */
    public function __construct(
        ?array $options = null,
        ?string $message = null,
        ?bool $alpha3 = null,
        ?array $groups = null,
        mixed $payload = null,
    ) {
        if (!class_exists(Languages::class)) {
            throw new LogicException('The Intl component is required to use the Language constraint. Try running "composer require symfony/intl".');
        }

        parent::__construct($options, $groups, $payload);

        $this->message = $message ?? $this->message;
        $this->alpha3 = $alpha3 ?? $this->alpha3;
    }
}
