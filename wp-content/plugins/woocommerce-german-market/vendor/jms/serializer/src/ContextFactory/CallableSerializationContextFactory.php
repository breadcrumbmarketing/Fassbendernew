<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace MarketPress\German_Market\JMS\Serializer\ContextFactory;

use MarketPress\German_Market\JMS\Serializer\SerializationContext;

/**
 * Serialization Context Factory using a callable.
 */
final class CallableSerializationContextFactory implements SerializationContextFactoryInterface
{
    /**
     * @var callable():SerializationContext
     */
    private $callable;

    /**
     * @param callable():SerializationContext $callable
     */
    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    public function createSerializationContext(): SerializationContext
    {
        $callable = $this->callable;

        return $callable();
    }
}
