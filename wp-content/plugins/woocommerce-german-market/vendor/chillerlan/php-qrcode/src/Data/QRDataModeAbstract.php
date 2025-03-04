<?php
/**
 * Class QRDataModeAbstract
 *
 * @created      19.11.2020
 * @author       smiley <smiley@chillerlan.net>
 * @copyright    2020 smiley
 * @license      MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\chillerlan\QRCode\Data;

use MarketPress\German_Market\chillerlan\QRCode\Common\Mode;

/**
 * abstract methods for the several data modes
 */
abstract class QRDataModeAbstract implements QRDataModeInterface{

	/**
	 * The data to write
	 */
	protected string $data;

	/**
	 * QRDataModeAbstract constructor.
	 *
	 * @throws \MarketPress\German_Market\chillerlan\QRCode\Data\QRCodeDataException
	 */
	public function __construct(string $data){
		$data = $this::convertEncoding($data);

		if(!$this::validateString($data)){
			throw new QRCodeDataException('invalid data');
		}

		$this->data = $data;
	}

	/**
	 * returns the character count of the $data string
	 */
	protected function getCharCount():int{
		return strlen($this->data);
	}

	/**
	 * @inheritDoc
	 */
	public static function convertEncoding(string $string):string{
		return $string;
	}

	/**
	 * shortcut
	 */
	protected static function getLengthBits(int $versionNumber):int{
		return Mode::getLengthBitsForVersion(static::DATAMODE, $versionNumber);
	}

}
