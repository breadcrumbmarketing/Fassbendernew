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

/**
 * Validates that a value is identical to another value.
 *
 * @author Daniel Holmes <daniel@danielholmes.org>
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class IdenticalTo extends AbstractComparison
{
    public const NOT_IDENTICAL_ERROR = '2a8cc50f-58a2-4536-875e-060a2ce69ed5';

    protected const ERROR_NAMES = [
        self::NOT_IDENTICAL_ERROR => 'NOT_IDENTICAL_ERROR',
    ];

    public string $message = 'This value should be identical to {{ compared_value_type }} {{ compared_value }}.';
}
