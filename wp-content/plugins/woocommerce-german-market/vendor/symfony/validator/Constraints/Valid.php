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
 * Validates an object embedded in an object's property.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Valid extends Constraint
{
    public bool $traverse = true;

    /**
     * @param array<string,mixed>|null $options
     * @param string[]|null            $groups
     * @param bool|null                $traverse Whether to validate {@see \Traversable} objects (defaults to true)
     */
    public function __construct(?array $options = null, ?array $groups = null, $payload = null, ?bool $traverse = null)
    {
        parent::__construct($options ?? [], $groups, $payload);

        $this->traverse = $traverse ?? $this->traverse;
    }

    public function __get(string $option): mixed
    {
        if ('groups' === $option) {
            // when this is reached, no groups have been configured
            return null;
        }

        return parent::__get($option);
    }

    public function addImplicitGroupName(string $group): void
    {
        if (null !== $this->groups) {
            parent::addImplicitGroupName($group);
        }
    }
}
