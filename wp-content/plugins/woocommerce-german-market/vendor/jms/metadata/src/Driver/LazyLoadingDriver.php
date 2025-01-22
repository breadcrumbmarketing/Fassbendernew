<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace MarketPress\German_Market\Metadata\Driver;

use MarketPress\German_Market\Metadata\ClassMetadata;
use Psr\Container\ContainerInterface as PsrContainerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LazyLoadingDriver implements DriverInterface
{
    /**
     * @var ContainerInterface|PsrContainerInterface
     */
    private $container;

    /**
     * @var string
     */
    private $realDriverId;

    /**
     * @param ContainerInterface|PsrContainerInterface $container
     */
    public function __construct($container, string $realDriverId)
    {
        if (!$container instanceof PsrContainerInterface && !$container instanceof ContainerInterface) {
            throw new \InvalidArgumentException(sprintf('The container must be an instance of %s or %s (%s given).', PsrContainerInterface::class, ContainerInterface::class, \is_object($container) ? \get_class($container) : \gettype($container)));
        }

        $this->container = $container;
        $this->realDriverId = $realDriverId;
    }

    public function loadMetadataForClass(\ReflectionClass $class): ?ClassMetadata
    {
        return $this->container->get($this->realDriverId)->loadMetadataForClass($class);
    }
}
