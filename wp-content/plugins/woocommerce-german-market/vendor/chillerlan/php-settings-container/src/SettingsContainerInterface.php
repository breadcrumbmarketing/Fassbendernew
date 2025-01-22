<?php
/**
 * Interface SettingsContainerInterface
 *
 * @created      28.08.2018
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2018 Smiley
 * @license      MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */
declare(strict_types=1);

namespace MarketPress\German_Market\chillerlan\Settings;

use JsonSerializable, Serializable;

/**
 * a generic container with magic getter and setter
 */
interface SettingsContainerInterface extends JsonSerializable, Serializable{

	/**
	 * Retrieve the value of $property
	 *
	 * @return mixed|null
	 */
	public function __get($property);

	/**
	 * Set $property to $value while avoiding private and non-existing properties
	 */
	public function __set($property, $value):void;

	/**
	 * Checks if $property is set (aka. not null), excluding private properties
	 */
	public function __isset(string $property):bool;

	/**
	 * Unsets $property while avoiding private and non-existing properties
	 */
	public function __unset(string $property):void;

	/**
	 * @see \MarketPress\German_Market\chillerlan\Settings\SettingsContainerInterface::toJSON()
	 */
	public function __toString():string;

	/**
	 * Returns an array representation of the settings object
	 *
	 * The values will be run through the magic __get(), which may also call custom getters.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray():array;

	/**
	 * Sets properties from a given iterable
	 *
	 * The values will be run through the magic __set(), which may also call custom setters.
	 *
	 *  @phpstan-param array<string, mixed> $properties
	 */
	public function fromIterable(iterable $properties);

	/**
	 * Returns a JSON representation of the settings object
	 *
	 * @see \json_encode()
	 * @see \MarketPress\German_Market\chillerlan\Settings\SettingsContainerInterface::toArray()
	 *
	 * @throws \JsonException
	 */
	public function toJSON($jsonOptions = null):string;

	/**
	 * Sets properties from a given JSON string
	 *
	 * @see \MarketPress\German_Market\chillerlan\Settings\SettingsContainerInterface::fromIterable()
	 *
	 * @throws \Exception
	 * @throws \JsonException
	 */
	public function fromJSON(string $json);

}
