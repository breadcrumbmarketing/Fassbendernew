<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types = 1);

namespace MarketPress\German_Market\PHPStan\PhpDocParser\Ast\PhpDoc;

use MarketPress\German_Market\PHPStan\PhpDocParser\Ast\NodeAttributes;
use MarketPress\German_Market\PHPStan\PhpDocParser\Ast\Type\TypeNode;
use function trim;

class AssertTagPropertyValueNode implements PhpDocTagValueNode
{

	use NodeAttributes;

	/** @var TypeNode */
	public $type;

	/** @var string */
	public $parameter;

	/** @var string */
	public $property;

	/** @var bool */
	public $isNegated;

	/** @var bool */
	public $isEquality;

	/** @var string (may be empty) */
	public $description;

	public function __construct(TypeNode $type, string $parameter, string $property, bool $isNegated, string $description, bool $isEquality = false)
	{
		$this->type = $type;
		$this->parameter = $parameter;
		$this->property = $property;
		$this->isNegated = $isNegated;
		$this->isEquality = $isEquality;
		$this->description = $description;
	}


	public function __toString(): string
	{
		$isNegated = $this->isNegated ? '!' : '';
		$isEquality = $this->isEquality ? '=' : '';
		return trim("{$isNegated}{$isEquality}{$this->type} {$this->parameter}->{$this->property} {$this->description}");
	}

}
