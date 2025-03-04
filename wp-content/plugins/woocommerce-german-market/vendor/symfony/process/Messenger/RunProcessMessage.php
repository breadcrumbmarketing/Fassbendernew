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

namespace MarketPress\German_Market\Symfony\Component\Process\Messenger;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class RunProcessMessage implements \Stringable
{
    public function __construct(
        public readonly array $command,
        public readonly ?string $cwd = null,
        public readonly ?array $env = null,
        public readonly mixed $input = null,
        public readonly ?float $timeout = 60.0,
    ) {
    }

    public function __toString(): string
    {
        return implode(' ', $this->command);
    }
}
