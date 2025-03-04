<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing TradeTaxType
 *
 * XSD Type: TradeTaxType
 */
class TradeTaxType
{

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\udt\AmountType $calculatedAmount
     */
    private $calculatedAmount = null;

    /**
     * @var string $typeCode
     */
    private $typeCode = null;

    /**
     * @var string $exemptionReason
     */
    private $exemptionReason = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\udt\AmountType $basisAmount
     */
    private $basisAmount = null;

    /**
     * @var string $categoryCode
     */
    private $categoryCode = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\udt\CodeType $exemptionReasonCode
     */
    private $exemptionReasonCode = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\udt\DateType $taxPointDate
     */
    private $taxPointDate = null;

    /**
     * @var string $dueDateTypeCode
     */
    private $dueDateTypeCode = null;

    /**
     * @var float $rateApplicablePercent
     */
    private $rateApplicablePercent = null;

    /**
     * Gets as calculatedAmount
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\udt\AmountType
     */
    public function getCalculatedAmount()
    {
        return $this->calculatedAmount;
    }

    /**
     * Sets a new calculatedAmount
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\udt\AmountType $calculatedAmount
     * @return self
     */
    public function setCalculatedAmount(?\MarketPress\German_Market\horstoeko\zugferd\entities\en16931\udt\AmountType $calculatedAmount = null)
    {
        $this->calculatedAmount = $calculatedAmount;
        return $this;
    }

    /**
     * Gets as typeCode
     *
     * @return string
     */
    public function getTypeCode()
    {
        return $this->typeCode;
    }

    /**
     * Sets a new typeCode
     *
     * @param  string $typeCode
     * @return self
     */
    public function setTypeCode($typeCode)
    {
        $this->typeCode = $typeCode;
        return $this;
    }

    /**
     * Gets as exemptionReason
     *
     * @return string
     */
    public function getExemptionReason()
    {
        return $this->exemptionReason;
    }

    /**
     * Sets a new exemptionReason
     *
     * @param  string $exemptionReason
     * @return self
     */
    public function setExemptionReason($exemptionReason)
    {
        $this->exemptionReason = $exemptionReason;
        return $this;
    }

    /**
     * Gets as basisAmount
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\udt\AmountType
     */
    public function getBasisAmount()
    {
        return $this->basisAmount;
    }

    /**
     * Sets a new basisAmount
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\udt\AmountType $basisAmount
     * @return self
     */
    public function setBasisAmount(?\MarketPress\German_Market\horstoeko\zugferd\entities\en16931\udt\AmountType $basisAmount = null)
    {
        $this->basisAmount = $basisAmount;
        return $this;
    }

    /**
     * Gets as categoryCode
     *
     * @return string
     */
    public function getCategoryCode()
    {
        return $this->categoryCode;
    }

    /**
     * Sets a new categoryCode
     *
     * @param  string $categoryCode
     * @return self
     */
    public function setCategoryCode($categoryCode)
    {
        $this->categoryCode = $categoryCode;
        return $this;
    }

    /**
     * Gets as exemptionReasonCode
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\udt\CodeType
     */
    public function getExemptionReasonCode()
    {
        return $this->exemptionReasonCode;
    }

    /**
     * Sets a new exemptionReasonCode
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\udt\CodeType $exemptionReasonCode
     * @return self
     */
    public function setExemptionReasonCode(?\MarketPress\German_Market\horstoeko\zugferd\entities\en16931\udt\CodeType $exemptionReasonCode = null)
    {
        $this->exemptionReasonCode = $exemptionReasonCode;
        return $this;
    }

    /**
     * Gets as taxPointDate
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\udt\DateType
     */
    public function getTaxPointDate()
    {
        return $this->taxPointDate;
    }

    /**
     * Sets a new taxPointDate
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\udt\DateType $taxPointDate
     * @return self
     */
    public function setTaxPointDate(?\MarketPress\German_Market\horstoeko\zugferd\entities\en16931\udt\DateType $taxPointDate = null)
    {
        $this->taxPointDate = $taxPointDate;
        return $this;
    }

    /**
     * Gets as dueDateTypeCode
     *
     * @return string
     */
    public function getDueDateTypeCode()
    {
        return $this->dueDateTypeCode;
    }

    /**
     * Sets a new dueDateTypeCode
     *
     * @param  string $dueDateTypeCode
     * @return self
     */
    public function setDueDateTypeCode($dueDateTypeCode)
    {
        $this->dueDateTypeCode = $dueDateTypeCode;
        return $this;
    }

    /**
     * Gets as rateApplicablePercent
     *
     * @return float
     */
    public function getRateApplicablePercent()
    {
        return $this->rateApplicablePercent;
    }

    /**
     * Sets a new rateApplicablePercent
     *
     * @param  float $rateApplicablePercent
     * @return self
     */
    public function setRateApplicablePercent($rateApplicablePercent)
    {
        $this->rateApplicablePercent = $rateApplicablePercent;
        return $this;
    }
}
