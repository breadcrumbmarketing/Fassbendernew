<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace MarketPress\German_Market\Metadata;

/**
 * Interface for advanced Metadata Factory implementations.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 * @author Jordan Stout <j@jrdn.org>
 */
interface AdvancedMetadataFactoryInterface extends MetadataFactoryInterface
{
    /**
     * Gets all the possible classes.
     *
     * @return string[]
     *
     * @throws \RuntimeException When driver does not an advanced driver.
     */
    public function getAllClassNames(): array;
}
