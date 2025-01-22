<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace MarketPress\German_Market\Doctrine\Instantiator;

use MarketPress\German_Market\Doctrine\Instantiator\Exception\ExceptionInterface;

/**
 * Instantiator provides utility methods to build objects without invoking their constructors
 */
interface InstantiatorInterface
{
    /**
     * @phpstan-param class-string<T> $className
     *
     * @phpstan-return T
     *
     * @throws ExceptionInterface
     *
     * @template T of object
     */
    public function instantiate(string $className): object;
}
