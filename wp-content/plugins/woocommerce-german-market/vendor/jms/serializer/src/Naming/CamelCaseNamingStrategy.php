<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace MarketPress\German_Market\JMS\Serializer\Naming;

use MarketPress\German_Market\JMS\Serializer\Metadata\PropertyMetadata;

/**
 * Generic naming strategy which translates a camel-cased property name.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
final class CamelCaseNamingStrategy implements PropertyNamingStrategyInterface
{
    /**
     * @var string
     */
    private $separator;

    /**
     * @var bool
     */
    private $lowerCase;

    public function __construct(string $separator = '_', bool $lowerCase = true)
    {
        $this->separator = $separator;
        $this->lowerCase = $lowerCase;
    }

    public function translateName(PropertyMetadata $property): string
    {
        $name = preg_replace('/[A-Z]+/', $this->separator . '\\0', $property->name);

        if ($this->lowerCase) {
            return strtolower($name);
        }

        return ucfirst($name);
    }
}
