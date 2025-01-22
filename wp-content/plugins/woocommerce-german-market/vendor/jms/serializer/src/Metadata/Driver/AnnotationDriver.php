<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace MarketPress\German_Market\JMS\Serializer\Metadata\Driver;

use Doctrine\Common\Annotations\Reader;
use MarketPress\German_Market\JMS\Serializer\Expression\CompilableExpressionEvaluatorInterface;
use MarketPress\German_Market\JMS\Serializer\Naming\PropertyNamingStrategyInterface;
use MarketPress\German_Market\JMS\Serializer\Type\ParserInterface;

/**
 * @deprecated
 */
class AnnotationDriver extends AnnotationOrAttributeDriver
{
    /**
     * @var Reader
     */
    private $reader;

    public function __construct(Reader $reader, PropertyNamingStrategyInterface $namingStrategy, ?ParserInterface $typeParser = null, ?CompilableExpressionEvaluatorInterface $expressionEvaluator = null)
    {
        parent::__construct($namingStrategy, $typeParser, $expressionEvaluator, $reader);

        $this->reader = $reader;
    }

    /**
     * @return list<object>
     */
    protected function getClassAnnotations(\ReflectionClass $class): array
    {
        return $this->reader->getClassAnnotations($class);
    }

    /**
     * @return list<object>
     */
    protected function getMethodAnnotations(\ReflectionMethod $method): array
    {
        return $this->reader->getMethodAnnotations($method);
    }

    /**
     * @return list<object>
     */
    protected function getPropertyAnnotations(\ReflectionProperty $property): array
    {
        return $this->reader->getPropertyAnnotations($property);
    }
}
