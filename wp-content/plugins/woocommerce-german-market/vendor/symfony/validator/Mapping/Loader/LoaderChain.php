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

namespace MarketPress\German_Market\Symfony\Component\Validator\Mapping\Loader;

use MarketPress\German_Market\Symfony\Component\Validator\Exception\MappingException;
use MarketPress\German_Market\Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * Loads validation metadata from multiple {@link LoaderInterface} instances.
 *
 * Pass the loaders when constructing the chain. Once
 * {@link loadClassMetadata()} is called, that method will be called on all
 * loaders in the chain.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class LoaderChain implements LoaderInterface
{
    /**
     * @param LoaderInterface[] $loaders The metadata loaders to use
     *
     * @throws MappingException If any of the loaders has an invalid type
     */
    public function __construct(
        protected array $loaders,
    ) {
        foreach ($loaders as $loader) {
            if (!$loader instanceof LoaderInterface) {
                throw new MappingException(sprintf('Class "%s" is expected to implement LoaderInterface.', get_debug_type($loader)));
            }
        }
    }

    public function loadClassMetadata(ClassMetadata $metadata): bool
    {
        $success = false;

        foreach ($this->loaders as $loader) {
            $success = $loader->loadClassMetadata($metadata) || $success;
        }

        return $success;
    }

    /**
     * @return LoaderInterface[]
     */
    public function getLoaders(): array
    {
        return $this->loaders;
    }
}
