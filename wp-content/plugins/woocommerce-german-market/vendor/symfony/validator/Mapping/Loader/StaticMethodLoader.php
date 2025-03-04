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
 * Loads validation metadata by calling a static method on the loaded class.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class StaticMethodLoader implements LoaderInterface
{
    /**
     * Creates a new loader.
     *
     * @param string $methodName The name of the static method to call
     */
    public function __construct(
        protected string $methodName = 'loadValidatorMetadata',
    ) {
    }

    public function loadClassMetadata(ClassMetadata $metadata): bool
    {
        /** @var \ReflectionClass $reflClass */
        $reflClass = $metadata->getReflectionClass();

        if (!$reflClass->isInterface() && $reflClass->hasMethod($this->methodName)) {
            $reflMethod = $reflClass->getMethod($this->methodName);

            if ($reflMethod->isAbstract()) {
                return false;
            }

            if (!$reflMethod->isStatic()) {
                throw new MappingException(sprintf('The method "%s::%s()" should be static.', $reflClass->name, $this->methodName));
            }

            if ($reflMethod->getDeclaringClass()->name != $reflClass->name) {
                return false;
            }

            $reflMethod->invoke(null, $metadata);

            return true;
        }

        return false;
    }
}
