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
 * Validates that a value is less than or equal to another value.
 *
 * @author Daniel Holmes <daniel@danielholmes.org>
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class LessThanOrEqual extends AbstractComparison
{
    public const TOO_HIGH_ERROR = '30fbb013-d015-4232-8b3b-8f3be97a7e14';

    protected const ERROR_NAMES = [
        self::TOO_HIGH_ERROR => 'TOO_HIGH_ERROR',
    ];

    public string $message = 'This value should be less than or equal to {{ compared_value }}.';
}
