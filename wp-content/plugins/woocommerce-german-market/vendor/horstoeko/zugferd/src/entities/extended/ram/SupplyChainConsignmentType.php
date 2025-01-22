<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing SupplyChainConsignmentType
 *
 * XSD Type: SupplyChainConsignmentType
 */
class SupplyChainConsignmentType
{

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\LogisticsTransportMovementType[] $specifiedLogisticsTransportMovement
     */
    private $specifiedLogisticsTransportMovement = [
        
    ];

    /**
     * Adds as specifiedLogisticsTransportMovement
     *
     * @return self
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\LogisticsTransportMovementType $specifiedLogisticsTransportMovement
     */
    public function addToSpecifiedLogisticsTransportMovement(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\LogisticsTransportMovementType $specifiedLogisticsTransportMovement)
    {
        $this->specifiedLogisticsTransportMovement[] = $specifiedLogisticsTransportMovement;
        return $this;
    }

    /**
     * isset specifiedLogisticsTransportMovement
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetSpecifiedLogisticsTransportMovement($index)
    {
        return isset($this->specifiedLogisticsTransportMovement[$index]);
    }

    /**
     * unset specifiedLogisticsTransportMovement
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetSpecifiedLogisticsTransportMovement($index)
    {
        unset($this->specifiedLogisticsTransportMovement[$index]);
    }

    /**
     * Gets as specifiedLogisticsTransportMovement
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\LogisticsTransportMovementType[]
     */
    public function getSpecifiedLogisticsTransportMovement()
    {
        return $this->specifiedLogisticsTransportMovement;
    }

    /**
     * Sets a new specifiedLogisticsTransportMovement
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\LogisticsTransportMovementType[] $specifiedLogisticsTransportMovement
     * @return self
     */
    public function setSpecifiedLogisticsTransportMovement(array $specifiedLogisticsTransportMovement = null)
    {
        $this->specifiedLogisticsTransportMovement = $specifiedLogisticsTransportMovement;
        return $this;
    }
}
