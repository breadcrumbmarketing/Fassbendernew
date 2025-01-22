<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace MarketPress\German_Market\JMS\Serializer\Handler;

use MarketPress\German_Market\JMS\Serializer\GraphNavigatorInterface;
use MarketPress\German_Market\JMS\Serializer\SerializationContext;
use MarketPress\German_Market\JMS\Serializer\Visitor\SerializationVisitorInterface;
use MarketPress\German_Market\JMS\Serializer\XmlSerializationVisitor;
use MarketPress\German_Market\Symfony\Component\Validator\ConstraintViolation;
use MarketPress\German_Market\Symfony\Component\Validator\ConstraintViolationList;

final class ConstraintViolationHandler implements SubscribingHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribingMethods()
    {
        $methods = [];
        $formats = ['xml', 'json'];
        $types = [ConstraintViolationList::class => 'serializeList', ConstraintViolation::class => 'serializeViolation'];

        foreach ($types as $type => $method) {
            foreach ($formats as $format) {
                $methods[] = [
                    'direction' => GraphNavigatorInterface::DIRECTION_SERIALIZATION,
                    'type' => $type,
                    'format' => $format,
                    'method' => $method . 'To' . $format,
                ];
            }
        }

        return $methods;
    }

    public function serializeListToXml(XmlSerializationVisitor $visitor, ConstraintViolationList $list, array $type): void
    {
        $currentNode = $visitor->getCurrentNode();
        if (!$currentNode) {
            $visitor->createRoot();
        }

        foreach ($list as $violation) {
            $this->serializeViolationToXml($visitor, $violation);
        }
    }

    /**
     * @return array|\ArrayObject
     */
    public function serializeListToJson(SerializationVisitorInterface $visitor, ConstraintViolationList $list, array $type, SerializationContext $context)
    {
        return $visitor->visitArray(iterator_to_array($list), $type);
    }

    public function serializeViolationToXml(XmlSerializationVisitor $visitor, ConstraintViolation $violation, ?array $type = null): void
    {
        $violationNode = $visitor->getDocument()->createElement('violation');

        $parent = $visitor->getCurrentNode();
        if (!$parent) {
            $visitor->setCurrentAndRootNode($violationNode);
        } else {
            $parent->appendChild($violationNode);
        }

        $violationNode->setAttribute('property_path', $violation->getPropertyPath());
        $violationNode->appendChild($messageNode = $visitor->getDocument()->createElement('message'));

        $messageNode->appendChild($visitor->getDocument()->createCDATASection($violation->getMessage()));
    }

    public function serializeViolationToJson(SerializationVisitorInterface $visitor, ConstraintViolation $violation, ?array $type = null): array
    {
        return [
            'property_path' => $violation->getPropertyPath(),
            'message' => $violation->getMessage(),
        ];
    }
}
