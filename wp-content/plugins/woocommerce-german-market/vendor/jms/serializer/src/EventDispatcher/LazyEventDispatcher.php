<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace MarketPress\German_Market\JMS\Serializer\EventDispatcher;

use MarketPress\German_Market\JMS\Serializer\Exception\InvalidArgumentException;
use Psr\Container\ContainerInterface as PsrContainerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LazyEventDispatcher extends EventDispatcher
{
    /**
     * @var PsrContainerInterface|ContainerInterface
     */
    private $container;

    /**
     * @param PsrContainerInterface|ContainerInterface $container
     */
    public function __construct($container)
    {
        if (!$container instanceof PsrContainerInterface && !$container instanceof ContainerInterface) {
            throw new InvalidArgumentException(sprintf('The container must be an instance of %s or %s (%s given).', PsrContainerInterface::class, ContainerInterface::class, \is_object($container) ? \get_class($container) : \gettype($container)));
        }

        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    protected function initializeListeners(string $eventName, string $loweredClass, string $format): array
    {
        $listeners = parent::initializeListeners($eventName, $loweredClass, $format);

        foreach ($listeners as &$listener) {
            if (!\is_array($listener[0]) || !\is_string($listener[0][0])) {
                continue;
            }

            if (!$this->container->has($listener[0][0])) {
                continue;
            }

            $listener[0][0] = $this->container->get($listener[0][0]);
        }

        return $listeners;
    }
}
