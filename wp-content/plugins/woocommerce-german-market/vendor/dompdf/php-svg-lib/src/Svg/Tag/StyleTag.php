<?php
/**
 * @package php-svg-lib
 * @link    http://github.com/dompdf/php-svg-lib
 * @license GNU LGPLv3+ http://www.gnu.org/copyleft/lesser.html
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\Svg\Tag;

use MarketPress\German_Market\Sabberworm\CSS;

class StyleTag extends AbstractTag
{
    protected $text = "";

    public function end()
    {
        $parser = new CSS\Parser($this->text);
        $this->document->appendStyleSheet($parser->parse());
    }

    public function appendText($text)
    {
        $this->text .= $text;
    }
} 
