<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace MarketPress\German_Market\JMS\Serializer\Metadata\Driver;

use MarketPress\German_Market\JMS\Serializer\Annotation\SerializerAttribute;

class AttributeDriver extends AnnotationOrAttributeDriver
{
    /**
     * @return list<SerializerAttribute>
     */
    protected function getClassAnnotations(\ReflectionClass $class): array
    {
        return array_map(
            static fn (\ReflectionAttribute $attribute): object => $attribute->newInstance(),
            $class->getAttributes(SerializerAttribute::class, \ReflectionAttribute::IS_INSTANCEOF),
        );
    }

    /**
     * @return list<SerializerAttribute>
     */
    protected function getMethodAnnotations(\ReflectionMethod $method): array
    {
        return array_map(
            static fn (\ReflectionAttribute $attribute): object => $attribute->newInstance(),
            $method->getAttributes(SerializerAttribute::class, \ReflectionAttribute::IS_INSTANCEOF),
        );
    }

    /**
     * @return list<SerializerAttribute>
     */
    protected function getPropertyAnnotations(\ReflectionProperty $property): array
    {
        return array_map(
            static fn (\ReflectionAttribute $attribute): object => $attribute->newInstance(),
            $property->getAttributes(SerializerAttribute::class, \ReflectionAttribute::IS_INSTANCEOF),
        );
    }
}
