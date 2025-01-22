<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace MarketPress\German_Market\JMS\Serializer\Annotation;

/**
 * @Annotation
 * @Target("CLASS")
 */
#[\Attribute(\Attribute::TARGET_CLASS)]
final class XmlRoot implements SerializerAttribute
{
    use AnnotationUtilsTrait;

    /**
     * @Required
     * @var string|null
     */
    public $name = null;

    /**
     * @var string|null
     */
    public $namespace = null;

    /**
     * @var string|null
     */
    public $prefix = null;

    public function __construct($values = [], ?string $name = null, ?string $namespace = null, ?string $prefix = null)
    {
        $this->loadAnnotationParameters(get_defined_vars());
    }
}
