<?php

/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\horstoeko\zugferd\quick;

use MarketPress\German_Market\horstoeko\zugferd\ZugferdProfiles;
use MarketPress\German_Market\horstoeko\zugferd\quick\ZugferdQuickDescriptor;

/**
 * Class representing the document descriptor for outgoing documents in XRECHNUNG 2.x profile
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class ZugferdQuickDescriptorXRechnung2 extends ZugferdQuickDescriptor
{
    /**
     * @inheritDoc
     */
    protected static function getProfile(): int
    {
        return ZugferdProfiles::PROFILE_XRECHNUNG_2_3;
    }
}
