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

/**
 * Defines custom validation rules through arbitrary callback methods.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Callback extends Constraint
{
    /**
     * @var string|callable
     */
    public $callback;

    /**
     * @param string|string[]|callable|array<string,mixed>|null $callback The callback definition
     * @param string[]|null                                     $groups
     */
    public function __construct(array|string|callable|null $callback = null, ?array $groups = null, mixed $payload = null, array $options = [])
    {
        // Invocation through attributes with an array parameter only
        if (\is_array($callback) && 1 === \count($callback) && isset($callback['value'])) {
            $callback = $callback['value'];
        }

        if (!\is_array($callback) || (!isset($callback['callback']) && !isset($callback['groups']) && !isset($callback['payload']))) {
            $options['callback'] = $callback;
        } else {
            $options = array_merge($callback, $options);
        }

        parent::__construct($options, $groups, $payload);
    }

    public function getDefaultOption(): ?string
    {
        return 'callback';
    }

    public function getTargets(): string|array
    {
        return [self::CLASS_CONSTRAINT, self::PROPERTY_CONSTRAINT];
    }
}
