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

namespace MarketPress\German_Market\Symfony\Component\Process\Exception;

use MarketPress\German_Market\Symfony\Component\Process\Process;

/**
 * Exception for processes failed during startup.
 */
class ProcessStartFailedException extends ProcessFailedException
{
    private Process $process;

    public function __construct(Process $process, ?string $message)
    {
        if ($process->isStarted()) {
            throw new InvalidArgumentException('Expected a process that failed during startup, but the given process was started successfully.');
        }

        $error = sprintf('The command "%s" failed.'."\n\nWorking directory: %s\n\nError: %s",
            $process->getCommandLine(),
            $process->getWorkingDirectory(),
            $message ?? 'unknown'
        );

        // Skip parent constructor
        RuntimeException::__construct($error);

        $this->process = $process;
    }

    public function getProcess(): Process
    {
        return $this->process;
    }
}
