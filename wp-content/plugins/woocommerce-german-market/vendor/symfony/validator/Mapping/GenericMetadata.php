<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\Symfony\Component\Validator\Mapping;

use MarketPress\German_Market\Symfony\Component\Validator\Constraint;
use MarketPress\German_Market\Symfony\Component\Validator\Constraints\Cascade;
use MarketPress\German_Market\Symfony\Component\Validator\Constraints\DisableAutoMapping;
use MarketPress\German_Market\Symfony\Component\Validator\Constraints\EnableAutoMapping;
use MarketPress\German_Market\Symfony\Component\Validator\Constraints\Traverse;
use MarketPress\German_Market\Symfony\Component\Validator\Constraints\Valid;
use MarketPress\German_Market\Symfony\Component\Validator\Exception\ConstraintDefinitionException;

/**
 * A generic container of {@link Constraint} objects.
 *
 * This class supports serialization and cloning.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class GenericMetadata implements MetadataInterface
{
    /**
     * @var Constraint[]
     *
     * @internal This property is public in order to reduce the size of the
     *           class' serialized representation. Do not access it. Use
     *           {@link getConstraints()} and {@link findConstraints()} instead.
     */
    public array $constraints = [];

    /**
     * @var array<string, Constraint[]>
     *
     * @internal This property is public in order to reduce the size of the
     *           class' serialized representation. Do not access it. Use
     *           {@link findConstraints()} instead.
     */
    public array $constraintsByGroup = [];

    /**
     * The strategy for cascading objects.
     *
     * By default, objects are not cascaded.
     *
     * @var CascadingStrategy::*
     *
     * @internal This property is public in order to reduce the size of the
     *           class' serialized representation. Do not access it. Use
     *           {@link getCascadingStrategy()} instead.
     */
    public int $cascadingStrategy = CascadingStrategy::NONE;

    /**
     * The strategy for traversing traversable objects.
     *
     * By default, traversable objects are not traversed.
     *
     * @var TraversalStrategy::*
     *
     * @internal This property is public in order to reduce the size of the
     *           class' serialized representation. Do not access it. Use
     *           {@link getTraversalStrategy()} instead.
     */
    public int $traversalStrategy = TraversalStrategy::NONE;

    /**
     * Is auto-mapping enabled?
     *
     * @var AutoMappingStrategy::*
     *
     * @internal This property is public in order to reduce the size of the
     *           class' serialized representation. Do not access it. Use
     *           {@link getAutoMappingStrategy()} instead.
     */
    public int $autoMappingStrategy = AutoMappingStrategy::NONE;

    /**
     * Returns the names of the properties that should be serialized.
     *
     * @return string[]
     */
    public function __sleep(): array
    {
        return [
            'constraints',
            'constraintsByGroup',
            'cascadingStrategy',
            'traversalStrategy',
            'autoMappingStrategy',
        ];
    }

    /**
     * Clones this object.
     */
    public function __clone()
    {
        $constraints = $this->constraints;

        $this->constraints = [];
        $this->constraintsByGroup = [];

        foreach ($constraints as $constraint) {
            $this->addConstraint(clone $constraint);
        }
    }

    /**
     * Adds a constraint.
     *
     * If the constraint {@link Valid} is added, the cascading strategy will be
     * changed to {@link CascadingStrategy::CASCADE}. Depending on the
     * $traverse property of that constraint, the traversal strategy
     * will be set to one of the following:
     *
     *  - {@link TraversalStrategy::IMPLICIT} if $traverse is enabled
     *  - {@link TraversalStrategy::NONE} if $traverse is disabled
     *
     * @return $this
     *
     * @throws ConstraintDefinitionException When trying to add the {@link Cascade}
     *                                       or {@link Traverse} constraint
     */
    public function addConstraint(Constraint $constraint): static
    {
        if ($constraint instanceof Traverse || $constraint instanceof Cascade) {
            throw new ConstraintDefinitionException(sprintf('The constraint "%s" can only be put on classes. Please use "MarketPress\German_Market\Symfony\Component\Validator\Constraints\Valid" instead.', get_debug_type($constraint)));
        }

        if ($constraint instanceof Valid && null === $constraint->groups) {
            $this->cascadingStrategy = CascadingStrategy::CASCADE;

            if ($constraint->traverse) {
                $this->traversalStrategy = TraversalStrategy::IMPLICIT;
            } else {
                $this->traversalStrategy = TraversalStrategy::NONE;
            }

            return $this;
        }

        if ($constraint instanceof DisableAutoMapping || $constraint instanceof EnableAutoMapping) {
            $this->autoMappingStrategy = $constraint instanceof EnableAutoMapping ? AutoMappingStrategy::ENABLED : AutoMappingStrategy::DISABLED;

            // The constraint is not added
            return $this;
        }

        $this->constraints[] = $constraint;

        foreach ($constraint->groups as $group) {
            $this->constraintsByGroup[$group][] = $constraint;
        }

        return $this;
    }

    /**
     * Adds an list of constraints.
     *
     * @param Constraint[] $constraints The constraints to add
     *
     * @return $this
     */
    public function addConstraints(array $constraints): static
    {
        foreach ($constraints as $constraint) {
            $this->addConstraint($constraint);
        }

        return $this;
    }

    /**
     * @return Constraint[]
     */
    public function getConstraints(): array
    {
        return $this->constraints;
    }

    /**
     * Returns whether this element has any constraints.
     */
    public function hasConstraints(): bool
    {
        return \count($this->constraints) > 0;
    }

    /**
     * Aware of the global group (* group).
     *
     * @return Constraint[]
     */
    public function findConstraints(string $group): array
    {
        return $this->constraintsByGroup[$group] ?? [];
    }

    public function getCascadingStrategy(): int
    {
        return $this->cascadingStrategy;
    }

    public function getTraversalStrategy(): int
    {
        return $this->traversalStrategy;
    }

    /**
     * @see AutoMappingStrategy
     */
    public function getAutoMappingStrategy(): int
    {
        return $this->autoMappingStrategy;
    }
}
