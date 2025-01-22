<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradeSettlementPaymentMeansType
 *
 * XSD Type: TradeSettlementPaymentMeansType
 */
class TradeSettlementPaymentMeansType
{

    /**
     * @var string $typeCode
     */
    private $typeCode = null;

    /**
     * @var string $information
     */
    private $information = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeSettlementFinancialCardType $applicableTradeSettlementFinancialCard
     */
    private $applicableTradeSettlementFinancialCard = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\DebtorFinancialAccountType $payerPartyDebtorFinancialAccount
     */
    private $payerPartyDebtorFinancialAccount = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\CreditorFinancialAccountType $payeePartyCreditorFinancialAccount
     */
    private $payeePartyCreditorFinancialAccount = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\CreditorFinancialInstitutionType $payeeSpecifiedCreditorFinancialInstitution
     */
    private $payeeSpecifiedCreditorFinancialInstitution = null;

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
     * Gets as information
     *
     * @return string
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * Sets a new information
     *
     * @param  string $information
     * @return self
     */
    public function setInformation($information)
    {
        $this->information = $information;
        return $this;
    }

    /**
     * Gets as applicableTradeSettlementFinancialCard
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeSettlementFinancialCardType
     */
    public function getApplicableTradeSettlementFinancialCard()
    {
        return $this->applicableTradeSettlementFinancialCard;
    }

    /**
     * Sets a new applicableTradeSettlementFinancialCard
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeSettlementFinancialCardType $applicableTradeSettlementFinancialCard
     * @return self
     */
    public function setApplicableTradeSettlementFinancialCard(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeSettlementFinancialCardType $applicableTradeSettlementFinancialCard = null)
    {
        $this->applicableTradeSettlementFinancialCard = $applicableTradeSettlementFinancialCard;
        return $this;
    }

    /**
     * Gets as payerPartyDebtorFinancialAccount
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\DebtorFinancialAccountType
     */
    public function getPayerPartyDebtorFinancialAccount()
    {
        return $this->payerPartyDebtorFinancialAccount;
    }

    /**
     * Sets a new payerPartyDebtorFinancialAccount
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\DebtorFinancialAccountType $payerPartyDebtorFinancialAccount
     * @return self
     */
    public function setPayerPartyDebtorFinancialAccount(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\DebtorFinancialAccountType $payerPartyDebtorFinancialAccount = null)
    {
        $this->payerPartyDebtorFinancialAccount = $payerPartyDebtorFinancialAccount;
        return $this;
    }

    /**
     * Gets as payeePartyCreditorFinancialAccount
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\CreditorFinancialAccountType
     */
    public function getPayeePartyCreditorFinancialAccount()
    {
        return $this->payeePartyCreditorFinancialAccount;
    }

    /**
     * Sets a new payeePartyCreditorFinancialAccount
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\CreditorFinancialAccountType $payeePartyCreditorFinancialAccount
     * @return self
     */
    public function setPayeePartyCreditorFinancialAccount(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\CreditorFinancialAccountType $payeePartyCreditorFinancialAccount = null)
    {
        $this->payeePartyCreditorFinancialAccount = $payeePartyCreditorFinancialAccount;
        return $this;
    }

    /**
     * Gets as payeeSpecifiedCreditorFinancialInstitution
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\CreditorFinancialInstitutionType
     */
    public function getPayeeSpecifiedCreditorFinancialInstitution()
    {
        return $this->payeeSpecifiedCreditorFinancialInstitution;
    }

    /**
     * Sets a new payeeSpecifiedCreditorFinancialInstitution
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\CreditorFinancialInstitutionType $payeeSpecifiedCreditorFinancialInstitution
     * @return self
     */
    public function setPayeeSpecifiedCreditorFinancialInstitution(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\CreditorFinancialInstitutionType $payeeSpecifiedCreditorFinancialInstitution = null)
    {
        $this->payeeSpecifiedCreditorFinancialInstitution = $payeeSpecifiedCreditorFinancialInstitution;
        return $this;
    }
}
