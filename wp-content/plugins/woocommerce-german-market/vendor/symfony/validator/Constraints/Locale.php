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

use Symfony\Component\Intl\Locales;
use MarketPress\German_Market\Symfony\Component\Validator\Constraint;
use MarketPress\German_Market\Symfony\Component\Validator\Exception\LogicException;

/**
 * Validates that a value is a valid locale (e.g. fr, fr_FR, etc.).
 *
 * @see https://unicode-org.github.io/icu/userguide/locale/
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Locale extends Constraint
{
    public const NO_SUCH_LOCALE_ERROR = 'a0af4293-1f1a-4a1c-a328-979cba6182a2';

    protected const ERROR_NAMES = [
        self::NO_SUCH_LOCALE_ERROR => 'NO_SUCH_LOCALE_ERROR',
    ];

    public string $message = 'This value is not a valid locale.';
    public bool $canonicalize = true;

    /**
     * @param array<string,mixed>|null $options
     * @param bool|null                $canonicalize Whether to canonicalize the value before validation (defaults to true) (see {@see https://www.php.net/manual/en/locale.canonicalize.php})
     * @param string[]|null            $groups
     */
    public function __construct(
        ?array $options = null,
        ?string $message = null,
        ?bool $canonicalize = null,
        ?array $groups = null,
        mixed $payload = null,
    ) {
        if (!class_exists(Locales::class)) {
            throw new LogicException('The Intl component is required to use the Locale constraint. Try running "composer require symfony/intl".');
        }

        parent::__construct($options, $groups, $payload);

        $this->message = $message ?? $this->message;
        $this->canonicalize = $canonicalize ?? $this->canonicalize;
    }
}
