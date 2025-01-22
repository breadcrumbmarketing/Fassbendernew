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
 * @Target({"PROPERTY","METHOD","ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_METHOD | \Attribute::TARGET_PROPERTY)]
final class XmlMap extends XmlCollection
{
    use AnnotationUtilsTrait;

    /**
     * @var string
     */
    public $keyAttribute = '_key';

    public function __construct(array $values = [], string $keyAttribute = '_key', string $entry = 'entry', bool $inline = false, ?string $namespace = null, bool $skipWhenEmpty = true)
    {
        $this->loadAnnotationParameters(get_defined_vars());
    }
}
