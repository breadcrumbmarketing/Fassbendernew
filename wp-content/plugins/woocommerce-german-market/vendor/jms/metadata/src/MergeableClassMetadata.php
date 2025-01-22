<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace MarketPress\German_Market\Metadata;

class MergeableClassMetadata extends ClassMetadata implements MergeableInterface
{
    public function merge(MergeableInterface $object): void
    {
        if (!$object instanceof MergeableClassMetadata) {
            throw new \InvalidArgumentException('$object must be an instance of MergeableClassMetadata.');
        }

        $this->name = $object->name;
        $this->methodMetadata = array_merge($this->methodMetadata, $object->methodMetadata);
        $this->propertyMetadata = array_merge($this->propertyMetadata, $object->propertyMetadata);
        $this->fileResources = array_merge($this->fileResources, $object->fileResources);

        if ($object->createdAt < $this->createdAt) {
            $this->createdAt = $object->createdAt;
        }
    }
}
