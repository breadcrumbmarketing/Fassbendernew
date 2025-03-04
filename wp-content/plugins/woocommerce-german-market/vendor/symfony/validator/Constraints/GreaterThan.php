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
 * Validates that a value is greater than another value.
 *
 * @author Daniel Holmes <daniel@danielholmes.org>
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class GreaterThan extends AbstractComparison
{
    public const TOO_LOW_ERROR = '778b7ae0-84d3-481a-9dec-35fdb64b1d78';

    protected const ERROR_NAMES = [
        self::TOO_LOW_ERROR => 'TOO_LOW_ERROR',
    ];

    public string $message = 'This value should be greater than {{ compared_value }}.';
}
