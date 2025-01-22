<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace MarketPress\German_Market\JMS\Serializer\Exclusion;

use MarketPress\German_Market\JMS\Serializer\Context;
use MarketPress\German_Market\JMS\Serializer\Metadata\ClassMetadata;
use MarketPress\German_Market\JMS\Serializer\Metadata\PropertyMetadata;

final class VersionExclusionStrategy implements ExclusionStrategyInterface
{
    /**
     * @var string
     */
    private $version;

    public function __construct(string $version)
    {
        $this->version = $version;
    }

    public function shouldSkipClass(ClassMetadata $metadata, Context $navigatorContext): bool
    {
        return false;
    }

    public function shouldSkipProperty(PropertyMetadata $property, Context $navigatorContext): bool
    {
        if ((null !== $version = $property->sinceVersion) && version_compare($this->version, $version, '<')) {
            return true;
        }

        return (null !== $version = $property->untilVersion) && version_compare($this->version, $version, '>');
    }
}
