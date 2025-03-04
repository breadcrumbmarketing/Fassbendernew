<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types = 1);

namespace MarketPress\German_Market\PHPStan\PhpDocParser\Ast\PhpDoc;

use MarketPress\German_Market\PHPStan\PhpDocParser\Ast\NodeAttributes;
use MarketPress\German_Market\PHPStan\PhpDocParser\Ast\PhpDoc\Doctrine\DoctrineTagValueNode;
use function trim;

class PhpDocTagNode implements PhpDocChildNode
{

	use NodeAttributes;

	/** @var string */
	public $name;

	/** @var PhpDocTagValueNode */
	public $value;

	public function __construct(string $name, PhpDocTagValueNode $value)
	{
		$this->name = $name;
		$this->value = $value;
	}


	public function __toString(): string
	{
		if ($this->value instanceof DoctrineTagValueNode) {
			return (string) $this->value;
		}

		return trim("{$this->name} {$this->value}");
	}

}
