<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types = 1);

namespace MarketPress\German_Market\PHPStan\PhpDocParser\Ast\ConstExpr;

use MarketPress\German_Market\PHPStan\PhpDocParser\Ast\NodeAttributes;

class ConstFetchNode implements ConstExprNode
{

	use NodeAttributes;

	/** @var string class name for class constants or empty string for non-class constants */
	public $className;

	/** @var string */
	public $name;

	public function __construct(string $className, string $name)
	{
		$this->className = $className;
		$this->name = $name;
	}


	public function __toString(): string
	{
		if ($this->className === '') {
			return $this->name;

		}

		return "{$this->className}::{$this->name}";
	}

}
