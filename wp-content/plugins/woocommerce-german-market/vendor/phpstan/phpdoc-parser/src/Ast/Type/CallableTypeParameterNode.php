<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types = 1);

namespace MarketPress\German_Market\PHPStan\PhpDocParser\Ast\Type;

use MarketPress\German_Market\PHPStan\PhpDocParser\Ast\Node;
use MarketPress\German_Market\PHPStan\PhpDocParser\Ast\NodeAttributes;
use function trim;

class CallableTypeParameterNode implements Node
{

	use NodeAttributes;

	/** @var TypeNode */
	public $type;

	/** @var bool */
	public $isReference;

	/** @var bool */
	public $isVariadic;

	/** @var string (may be empty) */
	public $parameterName;

	/** @var bool */
	public $isOptional;

	public function __construct(TypeNode $type, bool $isReference, bool $isVariadic, string $parameterName, bool $isOptional)
	{
		$this->type = $type;
		$this->isReference = $isReference;
		$this->isVariadic = $isVariadic;
		$this->parameterName = $parameterName;
		$this->isOptional = $isOptional;
	}


	public function __toString(): string
	{
		$type = "{$this->type} ";
		$isReference = $this->isReference ? '&' : '';
		$isVariadic = $this->isVariadic ? '...' : '';
		$isOptional = $this->isOptional ? '=' : '';
		return trim("{$type}{$isReference}{$isVariadic}{$this->parameterName}") . $isOptional;
	}

}
