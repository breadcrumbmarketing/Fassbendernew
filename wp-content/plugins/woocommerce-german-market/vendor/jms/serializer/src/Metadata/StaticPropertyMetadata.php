<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace MarketPress\German_Market\JMS\Serializer\Metadata;

class StaticPropertyMetadata extends PropertyMetadata
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * StaticPropertyMetadata constructor.
     *
     * @param mixed $fieldValue
     * @param array $groups
     */
    public function __construct(string $className, string $fieldName, $fieldValue, array $groups = [])
    {
        $this->class = $className;
        $this->name = $fieldName;
        $this->serializedName = $fieldName;
        $this->value = $fieldValue;
        $this->readOnly = true;
        $this->groups = $groups;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    public function setAccessor(string $type, ?string $getter = null, ?string $setter = null): void
    {
    }

    protected function serializeToArray(): array
    {
        return [
            $this->value,
            parent::serializeToArray(),
        ];
    }

    protected function unserializeFromArray(array $data): void
    {
        [
            $this->value,
            $parentData,
        ] = $data;

        parent::unserializeFromArray($parentData);
    }
}
