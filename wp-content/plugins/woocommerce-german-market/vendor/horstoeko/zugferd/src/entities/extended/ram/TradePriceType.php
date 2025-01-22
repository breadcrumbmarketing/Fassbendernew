<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradePriceType
 *
 * XSD Type: TradePriceType
 */
class TradePriceType
{

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\AmountType $chargeAmount
     */
    private $chargeAmount = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\QuantityType $basisQuantity
     */
    private $basisQuantity = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType[] $appliedTradeAllowanceCharge
     */
    private $appliedTradeAllowanceCharge = [
        
    ];

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeTaxType $includedTradeTax
     */
    private $includedTradeTax = null;

    /**
     * Gets as chargeAmount
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function getChargeAmount()
    {
        return $this->chargeAmount;
    }

    /**
     * Sets a new chargeAmount
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\AmountType $chargeAmount
     * @return self
     */
    public function setChargeAmount(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\AmountType $chargeAmount)
    {
        $this->chargeAmount = $chargeAmount;
        return $this;
    }

    /**
     * Gets as basisQuantity
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\QuantityType
     */
    public function getBasisQuantity()
    {
        return $this->basisQuantity;
    }

    /**
     * Sets a new basisQuantity
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\QuantityType $basisQuantity
     * @return self
     */
    public function setBasisQuantity(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\QuantityType $basisQuantity = null)
    {
        $this->basisQuantity = $basisQuantity;
        return $this;
    }

    /**
     * Adds as appliedTradeAllowanceCharge
     *
     * @return self
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType $appliedTradeAllowanceCharge
     */
    public function addToAppliedTradeAllowanceCharge(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType $appliedTradeAllowanceCharge)
    {
        $this->appliedTradeAllowanceCharge[] = $appliedTradeAllowanceCharge;
        return $this;
    }

    /**
     * isset appliedTradeAllowanceCharge
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetAppliedTradeAllowanceCharge($index)
    {
        return isset($this->appliedTradeAllowanceCharge[$index]);
    }

    /**
     * unset appliedTradeAllowanceCharge
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetAppliedTradeAllowanceCharge($index)
    {
        unset($this->appliedTradeAllowanceCharge[$index]);
    }

    /**
     * Gets as appliedTradeAllowanceCharge
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType[]
     */
    public function getAppliedTradeAllowanceCharge()
    {
        return $this->appliedTradeAllowanceCharge;
    }

    /**
     * Sets a new appliedTradeAllowanceCharge
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType[] $appliedTradeAllowanceCharge
     * @return self
     */
    public function setAppliedTradeAllowanceCharge(array $appliedTradeAllowanceCharge = null)
    {
        $this->appliedTradeAllowanceCharge = $appliedTradeAllowanceCharge;
        return $this;
    }

    /**
     * Gets as includedTradeTax
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeTaxType
     */
    public function getIncludedTradeTax()
    {
        return $this->includedTradeTax;
    }

    /**
     * Sets a new includedTradeTax
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeTaxType $includedTradeTax
     * @return self
     */
    public function setIncludedTradeTax(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeTaxType $includedTradeTax = null)
    {
        $this->includedTradeTax = $includedTradeTax;
        return $this;
    }
}
