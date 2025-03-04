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

namespace MarketPress\German_Market\Symfony\Component\Validator\Mapping\Factory;

use MarketPress\German_Market\Symfony\Component\Validator\Exception\NoSuchMetadataException;
use MarketPress\German_Market\Symfony\Component\Validator\Mapping\MetadataInterface;

/**
 * Returns {@link \Symfony\Component\Validator\Mapping\MetadataInterface} instances for values.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
interface MetadataFactoryInterface
{
    /**
     * Returns the metadata for the given value.
     *
     * @throws NoSuchMetadataException If no metadata exists for the given value
     */
    public function getMetadataFor(mixed $value): MetadataInterface;

    /**
     * Returns whether the class is able to return metadata for the given value.
     */
    public function hasMetadataFor(mixed $value): bool;
}
