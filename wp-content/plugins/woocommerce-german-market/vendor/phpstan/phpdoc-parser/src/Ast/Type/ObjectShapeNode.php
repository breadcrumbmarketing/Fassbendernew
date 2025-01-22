<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types = 1);

namespace MarketPress\German_Market\PHPStan\PhpDocParser\Ast\Type;

use MarketPress\German_Market\PHPStan\PhpDocParser\Ast\NodeAttributes;
use function implode;

class ObjectShapeNode implements TypeNode
{

	use NodeAttributes;

	/** @var ObjectShapeItemNode[] */
	public $items;

	/**
	 * @param ObjectShapeItemNode[] $items
	 */
	public function __construct(array $items)
	{
		$this->items = $items;
	}

	public function __toString(): string
	{
		$items = $this->items;

		return 'object{' . implode(', ', $items) . '}';
	}

}
