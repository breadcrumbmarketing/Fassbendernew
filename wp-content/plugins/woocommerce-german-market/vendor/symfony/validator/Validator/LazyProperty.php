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

namespace MarketPress\German_Market\Symfony\Component\Validator\Validator;

/**
 * A wrapper for a callable initializing a property from a getter.
 *
 * @internal
 */
class LazyProperty
{
    public function __construct(
        private \Closure $propertyValueCallback,
    ) {
    }

    public function getPropertyValue(): mixed
    {
        return ($this->propertyValueCallback)();
    }
}
