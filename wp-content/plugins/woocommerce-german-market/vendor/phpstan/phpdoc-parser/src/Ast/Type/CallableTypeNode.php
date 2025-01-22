<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types = 1);

namespace MarketPress\German_Market\PHPStan\PhpDocParser\Ast\Type;

use MarketPress\German_Market\PHPStan\PhpDocParser\Ast\NodeAttributes;
use MarketPress\German_Market\PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode;
use function implode;

class CallableTypeNode implements TypeNode
{

	use NodeAttributes;

	/** @var IdentifierTypeNode */
	public $identifier;

	/** @var TemplateTagValueNode[] */
	public $templateTypes;

	/** @var CallableTypeParameterNode[] */
	public $parameters;

	/** @var TypeNode */
	public $returnType;

	/**
	 * @param CallableTypeParameterNode[] $parameters
	 * @param TemplateTagValueNode[]  $templateTypes
	 */
	public function __construct(IdentifierTypeNode $identifier, array $parameters, TypeNode $returnType, array $templateTypes = [])
	{
		$this->identifier = $identifier;
		$this->parameters = $parameters;
		$this->returnType = $returnType;
		$this->templateTypes = $templateTypes;
	}


	public function __toString(): string
	{
		$returnType = $this->returnType;
		if ($returnType instanceof self) {
			$returnType = "({$returnType})";
		}
		$template = $this->templateTypes !== []
			? '<' . implode(', ', $this->templateTypes) . '>'
			: '';
		$parameters = implode(', ', $this->parameters);
		return "{$this->identifier}{$template}({$parameters}): {$returnType}";
	}

}
