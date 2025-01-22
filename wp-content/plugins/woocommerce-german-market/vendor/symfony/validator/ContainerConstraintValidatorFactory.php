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

namespace MarketPress\German_Market\Symfony\Component\Validator;

use Psr\Container\ContainerInterface;
use MarketPress\German_Market\Symfony\Component\Validator\Exception\UnexpectedTypeException;
use MarketPress\German_Market\Symfony\Component\Validator\Exception\ValidatorException;

/**
 * Uses a service container to create constraint validators.
 *
 * @author Kris Wallsmith <kris@symfony.com>
 */
class ContainerConstraintValidatorFactory implements ConstraintValidatorFactoryInterface
{
    private array $validators;

    public function __construct(
        private ContainerInterface $container,
    ) {
        $this->validators = [];
    }

    /**
     * @throws ValidatorException      When the validator class does not exist
     * @throws UnexpectedTypeException When the validator is not an instance of ConstraintValidatorInterface
     */
    public function getInstance(Constraint $constraint): ConstraintValidatorInterface
    {
        $name = $constraint->validatedBy();

        if (!isset($this->validators[$name])) {
            if ($this->container->has($name)) {
                $this->validators[$name] = $this->container->get($name);
            } else {
                if (!class_exists($name)) {
                    throw new ValidatorException(sprintf('Constraint validator "%s" does not exist or is not enabled. Check the "validatedBy" method in your constraint class "%s".', $name, get_debug_type($constraint)));
                }

                $this->validators[$name] = new $name();
            }
        }

        if (!$this->validators[$name] instanceof ConstraintValidatorInterface) {
            throw new UnexpectedTypeException($this->validators[$name], ConstraintValidatorInterface::class);
        }

        return $this->validators[$name];
    }
}
