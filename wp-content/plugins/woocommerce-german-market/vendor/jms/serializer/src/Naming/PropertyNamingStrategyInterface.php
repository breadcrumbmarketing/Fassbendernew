<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace MarketPress\German_Market\JMS\Serializer\Naming;

use MarketPress\German_Market\JMS\Serializer\Metadata\PropertyMetadata;

/**
 * Interface for property naming strategies.
 *
 * Implementations translate the property name to a serialized name that is
 * displayed.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
interface PropertyNamingStrategyInterface
{
    /**
     * Translates the name of the property to the serialized version.
     */
    public function translateName(PropertyMetadata $property): string;
}
