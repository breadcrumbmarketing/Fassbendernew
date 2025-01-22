<?php

/**
 * @package php-font-lib
 * @link    https://github.com/dompdf/php-font-lib
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\FontLib\Table\Type;

use MarketPress\German_Market\FontLib\Table\Table;

/**
 * `prep` font table.
 *
 * @package php-font-lib
 */
class prep extends Table
{
  private $rawData;
  protected function _parse() {
    $font = $this->getFont();
    $font->seek($this->entry->offset);
    $this->rawData = $font->read($this->entry->length);
  }
  function _encode() {
    return $this->getFont()->write($this->rawData, $this->entry->length);
  }
}
