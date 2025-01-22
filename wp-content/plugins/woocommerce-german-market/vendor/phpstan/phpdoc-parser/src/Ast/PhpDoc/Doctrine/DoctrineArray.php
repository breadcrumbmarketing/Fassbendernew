<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types = 1);

namespace MarketPress\German_Market\PHPStan\PhpDocParser\Ast\PhpDoc\Doctrine;

use MarketPress\German_Market\PHPStan\PhpDocParser\Ast\Node;
use MarketPress\German_Market\PHPStan\PhpDocParser\Ast\NodeAttributes;
use function implode;

class DoctrineArray implements Node
{

	use NodeAttributes;

	/** @var list<DoctrineArrayItem> */
	public $items;

	/**
	 * @param list<DoctrineArrayItem> $items
	 */
	public function __construct(array $items)
	{
		$this->items = $items;
	}

	public function __toString(): string
	{
		$items = implode(', ', $this->items);

		return '{' . $items . '}';
	}

}
