<?php

/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\horstoeko\zugferd\exception;

use Throwable;

/**
 * Class representing an exception for missing a file
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class ZugferdFileNotFoundException extends ZugferdBaseException
{
    /**
     * Constructor
     *
     * @param string         $filename
     * @param Throwable|null $previous
     */
    public function __construct(string $filename, ?Throwable $previous = null)
    {
        parent::__construct(sprintf("The file %s was not found", $filename), ZugferdExceptionCodes::FILENOTFOUND, $previous);
    }
}
