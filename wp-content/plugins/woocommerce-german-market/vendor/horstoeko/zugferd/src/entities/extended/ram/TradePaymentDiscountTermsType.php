<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradePaymentDiscountTermsType
 *
 * XSD Type: TradePaymentDiscountTermsType
 */
class TradePaymentDiscountTermsType
{

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\DateTimeType $basisDateTime
     */
    private $basisDateTime = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\MeasureType $basisPeriodMeasure
     */
    private $basisPeriodMeasure = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\AmountType $basisAmount
     */
    private $basisAmount = null;

    /**
     * @var float $calculationPercent
     */
    private $calculationPercent = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\AmountType $actualDiscountAmount
     */
    private $actualDiscountAmount = null;

    /**
     * Gets as basisDateTime
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\DateTimeType
     */
    public function getBasisDateTime()
    {
        return $this->basisDateTime;
    }

    /**
     * Sets a new basisDateTime
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\DateTimeType $basisDateTime
     * @return self
     */
    public function setBasisDateTime(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\DateTimeType $basisDateTime = null)
    {
        $this->basisDateTime = $basisDateTime;
        return $this;
    }

    /**
     * Gets as basisPeriodMeasure
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\MeasureType
     */
    public function getBasisPeriodMeasure()
    {
        return $this->basisPeriodMeasure;
    }

    /**
     * Sets a new basisPeriodMeasure
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\MeasureType $basisPeriodMeasure
     * @return self
     */
    public function setBasisPeriodMeasure(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\MeasureType $basisPeriodMeasure = null)
    {
        $this->basisPeriodMeasure = $basisPeriodMeasure;
        return $this;
    }

    /**
     * Gets as basisAmount
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function getBasisAmount()
    {
        return $this->basisAmount;
    }

    /**
     * Sets a new basisAmount
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\AmountType $basisAmount
     * @return self
     */
    public function setBasisAmount(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\AmountType $basisAmount = null)
    {
        $this->basisAmount = $basisAmount;
        return $this;
    }

    /**
     * Gets as calculationPercent
     *
     * @return float
     */
    public function getCalculationPercent()
    {
        return $this->calculationPercent;
    }

    /**
     * Sets a new calculationPercent
     *
     * @param  float $calculationPercent
     * @return self
     */
    public function setCalculationPercent($calculationPercent)
    {
        $this->calculationPercent = $calculationPercent;
        return $this;
    }

    /**
     * Gets as actualDiscountAmount
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function getActualDiscountAmount()
    {
        return $this->actualDiscountAmount;
    }

    /**
     * Sets a new actualDiscountAmount
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\AmountType $actualDiscountAmount
     * @return self
     */
    public function setActualDiscountAmount(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\AmountType $actualDiscountAmount = null)
    {
        $this->actualDiscountAmount = $actualDiscountAmount;
        return $this;
    }
}
