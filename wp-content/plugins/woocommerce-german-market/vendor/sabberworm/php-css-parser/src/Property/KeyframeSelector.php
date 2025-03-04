<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\Sabberworm\CSS\Property;

class KeyframeSelector extends Selector
{
    /**
     * regexp for specificity calculations
     *
     * @var string
     *
     * @internal
     */
    const SELECTOR_VALIDATION_RX = '/
    ^(
        (?:
            [a-zA-Z0-9\x{00A0}-\x{FFFF}_^$|*="\'~\[\]()\-\s\.:#+>]* # any sequence of valid unescaped characters
            (?:\\\\.)?                                              # a single escaped character
            (?:([\'"]).*?(?<!\\\\)\2)?                              # a quoted text like [id="example"]
        )*
    )|
    (\d+%)                                                          # keyframe animation progress percentage (e.g. 50%)
    $
    /ux';
}
