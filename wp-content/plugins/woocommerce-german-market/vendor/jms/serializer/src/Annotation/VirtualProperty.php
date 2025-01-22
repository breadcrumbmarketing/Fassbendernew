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
 * @Target({"METHOD", "CLASS"})
 *
 * @author Alexander Klimenkov <alx.devel@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_METHOD | \Attribute::TARGET_CLASS | \Attribute::IS_REPEATABLE)]
final class VirtualProperty implements SerializerAttribute
{
    use AnnotationUtilsTrait;

    /**
     * @var string|null
     */
    public $exp = null;

    /**
     * @var string|null
     */
    public $name = null;

    /**
     * @var array
     */
    public $options = [];

    public function __construct($values = [], ?string $name = null, ?string $exp = null, array $options = [])
    {
        $vars = get_defined_vars();
        unset($vars['options']);
        $this->loadAnnotationParameters($vars);

        if (0 !== count($options)) {
            $this->options = $options;
        }

        foreach ($options as $option) {
            if (is_array($option) && class_exists($option[0])) {
                $this->options[] = new $option[0]([], ...$option[1]);

                continue;
            }

            $this->options[] = $option;
        }
    }
}
