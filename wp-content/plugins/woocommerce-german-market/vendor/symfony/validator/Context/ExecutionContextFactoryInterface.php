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

namespace MarketPress\German_Market\Symfony\Component\Validator\Context;

use MarketPress\German_Market\Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Creates instances of {@link ExecutionContextInterface}.
 *
 * You can use a custom factory if you want to customize the execution context
 * that is passed through the validation run.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
interface ExecutionContextFactoryInterface
{
    /**
     * Creates a new execution context.
     *
     * @param mixed $root The root value of the validated
     *                    object graph
     */
    public function createContext(ValidatorInterface $validator, mixed $root): ExecutionContextInterface;
}
