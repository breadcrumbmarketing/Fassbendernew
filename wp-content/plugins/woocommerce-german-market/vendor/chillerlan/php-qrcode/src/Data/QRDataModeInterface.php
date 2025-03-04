<?php
/**
 * Interface QRDataModeInterface
 *
 * @created      01.12.2015
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2015 Smiley
 * @license      MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\chillerlan\QRCode\Data;

use MarketPress\German_Market\chillerlan\QRCode\Common\BitBuffer;

/**
 * Specifies the methods reqired for the data modules (Number, Alphanum, Byte and Kanji)
 */
interface QRDataModeInterface{

	/**
	 * the current data mode: Number, Alphanum, Kanji, Hanzi, Byte, ECI
	 *
	 * tbh I hate this constant here, but it's part of the interface, so I can't just declare it in the abstract class.
	 * (phan will complain about a PhanAccessOverridesFinalConstant)
	 *
	 * @see https://wiki.php.net/rfc/final_class_const
	 *
	 * @var int
	 * @see \MarketPress\German_Market\chillerlan\QRCode\Common\Mode
	 * @internal do not call this constant from the interface, but rather from one of the child classes
	 */
	public const DATAMODE = -1;

	/**
	 * retruns the length in bits of the data string
	 */
	public function getLengthInBits():int;

	/**
	 * encoding conversion helper
	 *
	 * @throws \MarketPress\German_Market\chillerlan\QRCode\Data\QRCodeDataException
	 */
	public static function convertEncoding(string $string):string;

	/**
	 * checks if the given string qualifies for the encoder module
	 */
	public static function validateString(string $string):bool;

	/**
	 * writes the actual data string to the BitBuffer, uses the given version to determine the length bits
	 *
	 * @see \MarketPress\German_Market\chillerlan\QRCode\Data\QRData::writeBitBuffer()
	 */
	public function write(BitBuffer $bitBuffer, int $versionNumber):QRDataModeInterface;

	/**
	 * reads a segment from the BitBuffer and decodes in the current data mode
	 */
	public static function decodeSegment(BitBuffer $bitBuffer, int $versionNumber):string;

}
