<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace MarketPress\German_Market\JMS\Serializer\Builder;

use Doctrine\Common\Annotations\Reader;
use MarketPress\German_Market\JMS\Serializer\Exception\LogicException;
use MarketPress\German_Market\Metadata\Driver\DriverInterface;

final class CallbackDriverFactory implements DriverFactoryInterface
{
    /**
     * @var callable
     * @phpstan-var callable(array $metadataDirs, Reader|null $reader): DriverInterface
     */
    private $callback;

    /**
     * @phpstan-param callable(array $metadataDirs, Reader|null $reader): DriverInterface $callable
     */
    public function __construct(callable $callable)
    {
        $this->callback = $callable;
    }

    public function createDriver(array $metadataDirs, ?Reader $reader = null): DriverInterface
    {
        $driver = \call_user_func($this->callback, $metadataDirs, $reader);
        if (!$driver instanceof DriverInterface) {
            throw new LogicException('The callback must return an instance of DriverInterface.');
        }

        return $driver;
    }
}
