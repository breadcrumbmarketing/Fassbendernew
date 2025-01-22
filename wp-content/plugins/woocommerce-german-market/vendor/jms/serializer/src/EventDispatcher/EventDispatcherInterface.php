<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace MarketPress\German_Market\JMS\Serializer\EventDispatcher;

interface EventDispatcherInterface
{
    /**
     * Returns whether there are listeners.
     */
    public function hasListeners(string $eventName, string $class, string $format): bool;

    /**
     * Dispatches an event.
     *
     * The listeners/subscribers are called in the same order in which they
     * were added to the dispatcher.
     */
    public function dispatch(string $eventName, string $class, string $format, Event $event): void;

    /**
     * Adds a listener.
     *
     * @param mixed $callable
     */
    public function addListener(string $eventName, $callable, ?string $class = null, ?string $format = null, ?string $interface = null): void;

    /**
     * Adds a subscribers.
     */
    public function addSubscriber(EventSubscriberInterface $subscriber): void;
}
