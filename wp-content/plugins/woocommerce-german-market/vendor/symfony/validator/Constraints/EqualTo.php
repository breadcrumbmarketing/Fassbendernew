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
 * Validates that a value is equal to another value.
 *
 * @author Daniel Holmes <daniel@danielholmes.org>
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class EqualTo extends AbstractComparison
{
    public const NOT_EQUAL_ERROR = '478618a7-95ba-473d-9101-cabd45e49115';

    protected const ERROR_NAMES = [
        self::NOT_EQUAL_ERROR => 'NOT_EQUAL_ERROR',
    ];

    public string $message = 'This value should be equal to {{ compared_value }}.';
}
