<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace MarketPress\German_Market\JMS\Serializer\Visitor;

use MarketPress\German_Market\JMS\Serializer\Metadata\ClassMetadata;
use MarketPress\German_Market\JMS\Serializer\Metadata\PropertyMetadata;
use MarketPress\German_Market\JMS\Serializer\VisitorInterface;

/**
 * Interface for visitors.
 *
 * This contains the minimal set of values that must be supported for any
 * output format.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 * @author Asmir Mustafic <goetas@gmail.com>
 */
interface SerializationVisitorInterface extends VisitorInterface
{
    /**
     * @param mixed $data
     *
     * @return mixed
     */
    public function visitNull($data, array $type);

    /**
     * @return mixed
     */
    public function visitString(string $data, array $type);

    /**
     * @return mixed
     */
    public function visitBoolean(bool $data, array $type);

    /**
     * @return mixed
     */
    public function visitDouble(float $data, array $type);

    /**
     * @return mixed
     */
    public function visitInteger(int $data, array $type);

    /**
     * @return array|\ArrayObject|void
     */
    public function visitArray(array $data, array $type);

    /**
     * Called before the properties of the object are being visited.
     */
    public function startVisitingObject(ClassMetadata $metadata, object $data, array $type): void;

    /**
     * @param mixed $data
     */
    public function visitProperty(PropertyMetadata $metadata, $data): void;

    /**
     * Called after all properties of the object have been visited.
     *
     * @return array|\ArrayObject|void
     */
    public function endVisitingObject(ClassMetadata $metadata, object $data, array $type);
}
