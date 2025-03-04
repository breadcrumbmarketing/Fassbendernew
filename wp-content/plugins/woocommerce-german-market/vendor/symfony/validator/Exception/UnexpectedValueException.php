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

namespace MarketPress\German_Market\Symfony\Component\Validator\Exception;

/**
 * @author Christian Flothmann <christian.flothmann@sensiolabs.de>
 */
class UnexpectedValueException extends UnexpectedTypeException
{
    public function __construct(
        mixed $value,
        private string $expectedType,
    ) {
        parent::__construct($value, $expectedType);
    }

    public function getExpectedType(): string
    {
        return $this->expectedType;
    }
}
