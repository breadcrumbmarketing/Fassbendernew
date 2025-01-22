<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace MarketPress\German_Market\JMS\Serializer\EventDispatcher\Subscriber;

use MarketPress\German_Market\JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use MarketPress\German_Market\JMS\Serializer\EventDispatcher\ObjectEvent;
use MarketPress\German_Market\JMS\Serializer\Exception\ValidationFailedException;
use MarketPress\German_Market\Symfony\Component\Validator\Validator\ValidatorInterface;

final class SymfonyValidatorValidatorSubscriber implements EventSubscriberInterface
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            ['event' => 'serializer.post_deserialize', 'method' => 'onPostDeserialize'],
        ];
    }

    public function onPostDeserialize(ObjectEvent $event): void
    {
        $context = $event->getContext();

        if ($context->getDepth() > 0) {
            return;
        }

        $validator = $this->validator;
        $groups = $context->hasAttribute('validation_groups') ? $context->getAttribute('validation_groups') : null;

        if (!$groups) {
            return;
        }

        $constraints = $context->hasAttribute('validation_constraints') ? $context->getAttribute('validation_constraints') : null;

        $list = $validator->validate($event->getObject(), $constraints, $groups);

        if ($list->count() > 0) {
            throw new ValidationFailedException($list);
        }
    }
}
