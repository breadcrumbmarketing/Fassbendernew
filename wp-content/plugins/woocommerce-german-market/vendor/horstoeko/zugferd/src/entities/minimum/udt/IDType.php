<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\horstoeko\zugferd\entities\minimum\udt;

/**
 * Class representing IDType
 *
 * XSD Type: IDType
 */
class IDType
{

    /**
     * @var string $__value
     */
    private $__value = null;

    /**
     * @var string $schemeID
     */
    private $schemeID = null;

    /**
     * Construct
     *
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value($value);
    }

    /**
     * Gets or sets the inner value
     *
     * @param  string $value
     * @return string
     */
    public function value()
    {
        if ($args = func_get_args()) {
            $this->__value = $args[0];
        }
        return $this->__value;
    }

    /**
     * Gets a string value
     *
     * @return string
     */
    public function __toString()
    {
        return strval($this->__value);
    }

    /**
     * Gets as schemeID
     *
     * @return string
     */
    public function getSchemeID()
    {
        return $this->schemeID;
    }

    /**
     * Sets a new schemeID
     *
     * @param  string $schemeID
     * @return self
     */
    public function setSchemeID($schemeID)
    {
        $this->schemeID = $schemeID;
        return $this;
    }
}
