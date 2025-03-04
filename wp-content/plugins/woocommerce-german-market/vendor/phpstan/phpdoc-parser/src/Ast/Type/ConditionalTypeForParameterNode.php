<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types = 1);

namespace MarketPress\German_Market\PHPStan\PhpDocParser\Ast\Type;

use MarketPress\German_Market\PHPStan\PhpDocParser\Ast\NodeAttributes;
use function sprintf;

class ConditionalTypeForParameterNode implements TypeNode
{

	use NodeAttributes;

	/** @var string */
	public $parameterName;

	/** @var TypeNode */
	public $targetType;

	/** @var TypeNode */
	public $if;

	/** @var TypeNode */
	public $else;

	/** @var bool */
	public $negated;

	public function __construct(string $parameterName, TypeNode $targetType, TypeNode $if, TypeNode $else, bool $negated)
	{
		$this->parameterName = $parameterName;
		$this->targetType = $targetType;
		$this->if = $if;
		$this->else = $else;
		$this->negated = $negated;
	}

	public function __toString(): string
	{
		return sprintf(
			'(%s %s %s ? %s : %s)',
			$this->parameterName,
			$this->negated ? 'is not' : 'is',
			$this->targetType,
			$this->if,
			$this->else
		);
	}

}
