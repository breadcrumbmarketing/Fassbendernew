<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types = 1);

namespace MarketPress\German_Market\PHPStan\PhpDocParser\Ast\PhpDoc\Doctrine;

use MarketPress\German_Market\PHPStan\PhpDocParser\Ast\ConstExpr\ConstExprIntegerNode;
use MarketPress\German_Market\PHPStan\PhpDocParser\Ast\ConstExpr\ConstExprStringNode;
use MarketPress\German_Market\PHPStan\PhpDocParser\Ast\ConstExpr\ConstFetchNode;
use MarketPress\German_Market\PHPStan\PhpDocParser\Ast\Node;
use MarketPress\German_Market\PHPStan\PhpDocParser\Ast\NodeAttributes;
use MarketPress\German_Market\PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;

/**
 * @phpstan-import-type ValueType from DoctrineArgument
 * @phpstan-type KeyType = ConstExprIntegerNode|ConstExprStringNode|IdentifierTypeNode|ConstFetchNode|null
 */
class DoctrineArrayItem implements Node
{

	use NodeAttributes;

	/** @var KeyType */
	public $key;

	/** @var ValueType */
	public $value;

	/**
	 * @param KeyType $key
	 * @param ValueType $value
	 */
	public function __construct($key, $value)
	{
		$this->key = $key;
		$this->value = $value;
	}


	public function __toString(): string
	{
		if ($this->key === null) {
			return (string) $this->value;
		}

		return $this->key . '=' . $this->value;
	}

}
