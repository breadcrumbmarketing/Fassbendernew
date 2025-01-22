<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace MarketPress\German_Market\JMS\Serializer\Metadata\Driver;

use MarketPress\German_Market\JMS\Serializer\Metadata\ClassMetadata as SerializerClassMetadata;
use MarketPress\German_Market\JMS\Serializer\Metadata\Driver\DocBlockDriver\DocBlockTypeResolver;
use MarketPress\German_Market\JMS\Serializer\Metadata\ExpressionPropertyMetadata;
use MarketPress\German_Market\JMS\Serializer\Metadata\PropertyMetadata;
use MarketPress\German_Market\JMS\Serializer\Metadata\StaticPropertyMetadata;
use MarketPress\German_Market\JMS\Serializer\Metadata\VirtualPropertyMetadata;
use MarketPress\German_Market\JMS\Serializer\Type\Parser;
use MarketPress\German_Market\JMS\Serializer\Type\ParserInterface;
use MarketPress\German_Market\Metadata\ClassMetadata;
use MarketPress\German_Market\Metadata\Driver\DriverInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionProperty;

class DocBlockDriver implements DriverInterface
{
    /**
     * @var DriverInterface
     */
    protected $delegate;

    /**
     * @var ParserInterface
     */
    protected $typeParser;
    /**
     * @var DocBlockTypeResolver
     */
    private $docBlockTypeResolver;

    public function __construct(DriverInterface $delegate, ?ParserInterface $typeParser = null)
    {
        $this->delegate = $delegate;
        $this->typeParser = $typeParser ?: new Parser();
        $this->docBlockTypeResolver = new DocBlockTypeResolver();
    }

    /**
     * @return SerializerClassMetadata|null
     */
    public function loadMetadataForClass(ReflectionClass $class): ?ClassMetadata
    {
        $classMetadata = $this->delegate->loadMetadataForClass($class);

        if (null === $classMetadata) {
            return null;
        }

        \assert($classMetadata instanceof SerializerClassMetadata);

        // We base our scan on the internal driver's property list so that we
        // respect any internal allow/blocklist like in the AnnotationDriver
        foreach ($classMetadata->propertyMetadata as $key => $propertyMetadata) {
            // If the inner driver provides a type, don't guess anymore.
            if ($propertyMetadata->type) {
                continue;
            }

            if ($this->isNotSupportedVirtualProperty($propertyMetadata)) {
                continue;
            }

            try {
                if ($propertyMetadata instanceof VirtualPropertyMetadata) {
                    $type = $this->docBlockTypeResolver->getMethodDocblockTypeHint(
                        new ReflectionMethod($propertyMetadata->class, $propertyMetadata->getter),
                    );
                } else {
                    $type = $this->docBlockTypeResolver->getPropertyDocblockTypeHint(
                        new ReflectionProperty($propertyMetadata->class, $propertyMetadata->name),
                    );
                }

                if ($type) {
                    $propertyMetadata->setType($this->typeParser->parse($type));
                }
            } catch (ReflectionException $e) {
                continue;
            }
        }

        return $classMetadata;
    }

    private function isNotSupportedVirtualProperty(PropertyMetadata $propertyMetadata): bool
    {
        return $propertyMetadata instanceof StaticPropertyMetadata
            || $propertyMetadata instanceof ExpressionPropertyMetadata;
    }
}
