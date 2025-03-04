<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing HeaderTradeSettlementType
 *
 * XSD Type: HeaderTradeSettlementType
 */
class HeaderTradeSettlementType
{

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType $creditorReferenceID
     */
    private $creditorReferenceID = null;

    /**
     * @var string $paymentReference
     */
    private $paymentReference = null;

    /**
     * @var string $taxCurrencyCode
     */
    private $taxCurrencyCode = null;

    /**
     * @var string $invoiceCurrencyCode
     */
    private $invoiceCurrencyCode = null;

    /**
     * @var string $invoiceIssuerReference
     */
    private $invoiceIssuerReference = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePartyType $invoicerTradeParty
     */
    private $invoicerTradeParty = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePartyType $invoiceeTradeParty
     */
    private $invoiceeTradeParty = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePartyType $payeeTradeParty
     */
    private $payeeTradeParty = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePartyType $payerTradeParty
     */
    private $payerTradeParty = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeCurrencyExchangeType $taxApplicableTradeCurrencyExchange
     */
    private $taxApplicableTradeCurrencyExchange = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeSettlementPaymentMeansType[] $specifiedTradeSettlementPaymentMeans
     */
    private $specifiedTradeSettlementPaymentMeans = [
        
    ];

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeTaxType[] $applicableTradeTax
     */
    private $applicableTradeTax = [
        
    ];

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType $billingSpecifiedPeriod
     */
    private $billingSpecifiedPeriod = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType[] $specifiedTradeAllowanceCharge
     */
    private $specifiedTradeAllowanceCharge = [
        
    ];

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\LogisticsServiceChargeType[] $specifiedLogisticsServiceCharge
     */
    private $specifiedLogisticsServiceCharge = [
        
    ];

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePaymentTermsType[] $specifiedTradePaymentTerms
     */
    private $specifiedTradePaymentTerms = [
        
    ];

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeSettlementHeaderMonetarySummationType $specifiedTradeSettlementHeaderMonetarySummation
     */
    private $specifiedTradeSettlementHeaderMonetarySummation = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[] $invoiceReferencedDocument
     */
    private $invoiceReferencedDocument = [
        
    ];

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeAccountingAccountType[] $receivableSpecifiedTradeAccountingAccount
     */
    private $receivableSpecifiedTradeAccountingAccount = [
        
    ];

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\AdvancePaymentType[] $specifiedAdvancePayment
     */
    private $specifiedAdvancePayment = [
        
    ];

    /**
     * Gets as creditorReferenceID
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function getCreditorReferenceID()
    {
        return $this->creditorReferenceID;
    }

    /**
     * Sets a new creditorReferenceID
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType $creditorReferenceID
     * @return self
     */
    public function setCreditorReferenceID(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType $creditorReferenceID = null)
    {
        $this->creditorReferenceID = $creditorReferenceID;
        return $this;
    }

    /**
     * Gets as paymentReference
     *
     * @return string
     */
    public function getPaymentReference()
    {
        return $this->paymentReference;
    }

    /**
     * Sets a new paymentReference
     *
     * @param  string $paymentReference
     * @return self
     */
    public function setPaymentReference($paymentReference)
    {
        $this->paymentReference = $paymentReference;
        return $this;
    }

    /**
     * Gets as taxCurrencyCode
     *
     * @return string
     */
    public function getTaxCurrencyCode()
    {
        return $this->taxCurrencyCode;
    }

    /**
     * Sets a new taxCurrencyCode
     *
     * @param  string $taxCurrencyCode
     * @return self
     */
    public function setTaxCurrencyCode($taxCurrencyCode)
    {
        $this->taxCurrencyCode = $taxCurrencyCode;
        return $this;
    }

    /**
     * Gets as invoiceCurrencyCode
     *
     * @return string
     */
    public function getInvoiceCurrencyCode()
    {
        return $this->invoiceCurrencyCode;
    }

    /**
     * Sets a new invoiceCurrencyCode
     *
     * @param  string $invoiceCurrencyCode
     * @return self
     */
    public function setInvoiceCurrencyCode($invoiceCurrencyCode)
    {
        $this->invoiceCurrencyCode = $invoiceCurrencyCode;
        return $this;
    }

    /**
     * Gets as invoiceIssuerReference
     *
     * @return string
     */
    public function getInvoiceIssuerReference()
    {
        return $this->invoiceIssuerReference;
    }

    /**
     * Sets a new invoiceIssuerReference
     *
     * @param  string $invoiceIssuerReference
     * @return self
     */
    public function setInvoiceIssuerReference($invoiceIssuerReference)
    {
        $this->invoiceIssuerReference = $invoiceIssuerReference;
        return $this;
    }

    /**
     * Gets as invoicerTradeParty
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePartyType
     */
    public function getInvoicerTradeParty()
    {
        return $this->invoicerTradeParty;
    }

    /**
     * Sets a new invoicerTradeParty
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePartyType $invoicerTradeParty
     * @return self
     */
    public function setInvoicerTradeParty(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePartyType $invoicerTradeParty = null)
    {
        $this->invoicerTradeParty = $invoicerTradeParty;
        return $this;
    }

    /**
     * Gets as invoiceeTradeParty
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePartyType
     */
    public function getInvoiceeTradeParty()
    {
        return $this->invoiceeTradeParty;
    }

    /**
     * Sets a new invoiceeTradeParty
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePartyType $invoiceeTradeParty
     * @return self
     */
    public function setInvoiceeTradeParty(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePartyType $invoiceeTradeParty = null)
    {
        $this->invoiceeTradeParty = $invoiceeTradeParty;
        return $this;
    }

    /**
     * Gets as payeeTradeParty
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePartyType
     */
    public function getPayeeTradeParty()
    {
        return $this->payeeTradeParty;
    }

    /**
     * Sets a new payeeTradeParty
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePartyType $payeeTradeParty
     * @return self
     */
    public function setPayeeTradeParty(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePartyType $payeeTradeParty = null)
    {
        $this->payeeTradeParty = $payeeTradeParty;
        return $this;
    }

    /**
     * Gets as payerTradeParty
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePartyType
     */
    public function getPayerTradeParty()
    {
        return $this->payerTradeParty;
    }

    /**
     * Sets a new payerTradeParty
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePartyType $payerTradeParty
     * @return self
     */
    public function setPayerTradeParty(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePartyType $payerTradeParty = null)
    {
        $this->payerTradeParty = $payerTradeParty;
        return $this;
    }

    /**
     * Gets as taxApplicableTradeCurrencyExchange
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeCurrencyExchangeType
     */
    public function getTaxApplicableTradeCurrencyExchange()
    {
        return $this->taxApplicableTradeCurrencyExchange;
    }

    /**
     * Sets a new taxApplicableTradeCurrencyExchange
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeCurrencyExchangeType $taxApplicableTradeCurrencyExchange
     * @return self
     */
    public function setTaxApplicableTradeCurrencyExchange(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeCurrencyExchangeType $taxApplicableTradeCurrencyExchange = null)
    {
        $this->taxApplicableTradeCurrencyExchange = $taxApplicableTradeCurrencyExchange;
        return $this;
    }

    /**
     * Adds as specifiedTradeSettlementPaymentMeans
     *
     * @return self
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeSettlementPaymentMeansType $specifiedTradeSettlementPaymentMeans
     */
    public function addToSpecifiedTradeSettlementPaymentMeans(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeSettlementPaymentMeansType $specifiedTradeSettlementPaymentMeans)
    {
        $this->specifiedTradeSettlementPaymentMeans[] = $specifiedTradeSettlementPaymentMeans;
        return $this;
    }

    /**
     * isset specifiedTradeSettlementPaymentMeans
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetSpecifiedTradeSettlementPaymentMeans($index)
    {
        return isset($this->specifiedTradeSettlementPaymentMeans[$index]);
    }

    /**
     * unset specifiedTradeSettlementPaymentMeans
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetSpecifiedTradeSettlementPaymentMeans($index)
    {
        unset($this->specifiedTradeSettlementPaymentMeans[$index]);
    }

    /**
     * Gets as specifiedTradeSettlementPaymentMeans
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeSettlementPaymentMeansType[]
     */
    public function getSpecifiedTradeSettlementPaymentMeans()
    {
        return $this->specifiedTradeSettlementPaymentMeans;
    }

    /**
     * Sets a new specifiedTradeSettlementPaymentMeans
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeSettlementPaymentMeansType[] $specifiedTradeSettlementPaymentMeans
     * @return self
     */
    public function setSpecifiedTradeSettlementPaymentMeans(array $specifiedTradeSettlementPaymentMeans = null)
    {
        $this->specifiedTradeSettlementPaymentMeans = $specifiedTradeSettlementPaymentMeans;
        return $this;
    }

    /**
     * Adds as applicableTradeTax
     *
     * @return self
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeTaxType $applicableTradeTax
     */
    public function addToApplicableTradeTax(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeTaxType $applicableTradeTax)
    {
        $this->applicableTradeTax[] = $applicableTradeTax;
        return $this;
    }

    /**
     * isset applicableTradeTax
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetApplicableTradeTax($index)
    {
        return isset($this->applicableTradeTax[$index]);
    }

    /**
     * unset applicableTradeTax
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetApplicableTradeTax($index)
    {
        unset($this->applicableTradeTax[$index]);
    }

    /**
     * Gets as applicableTradeTax
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeTaxType[]
     */
    public function getApplicableTradeTax()
    {
        return $this->applicableTradeTax;
    }

    /**
     * Sets a new applicableTradeTax
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeTaxType[] $applicableTradeTax
     * @return self
     */
    public function setApplicableTradeTax(array $applicableTradeTax)
    {
        $this->applicableTradeTax = $applicableTradeTax;
        return $this;
    }

    /**
     * Gets as billingSpecifiedPeriod
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType
     */
    public function getBillingSpecifiedPeriod()
    {
        return $this->billingSpecifiedPeriod;
    }

    /**
     * Sets a new billingSpecifiedPeriod
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType $billingSpecifiedPeriod
     * @return self
     */
    public function setBillingSpecifiedPeriod(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType $billingSpecifiedPeriod = null)
    {
        $this->billingSpecifiedPeriod = $billingSpecifiedPeriod;
        return $this;
    }

    /**
     * Adds as specifiedTradeAllowanceCharge
     *
     * @return self
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType $specifiedTradeAllowanceCharge
     */
    public function addToSpecifiedTradeAllowanceCharge(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType $specifiedTradeAllowanceCharge)
    {
        $this->specifiedTradeAllowanceCharge[] = $specifiedTradeAllowanceCharge;
        return $this;
    }

    /**
     * isset specifiedTradeAllowanceCharge
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetSpecifiedTradeAllowanceCharge($index)
    {
        return isset($this->specifiedTradeAllowanceCharge[$index]);
    }

    /**
     * unset specifiedTradeAllowanceCharge
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetSpecifiedTradeAllowanceCharge($index)
    {
        unset($this->specifiedTradeAllowanceCharge[$index]);
    }

    /**
     * Gets as specifiedTradeAllowanceCharge
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType[]
     */
    public function getSpecifiedTradeAllowanceCharge()
    {
        return $this->specifiedTradeAllowanceCharge;
    }

    /**
     * Sets a new specifiedTradeAllowanceCharge
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType[] $specifiedTradeAllowanceCharge
     * @return self
     */
    public function setSpecifiedTradeAllowanceCharge(array $specifiedTradeAllowanceCharge = null)
    {
        $this->specifiedTradeAllowanceCharge = $specifiedTradeAllowanceCharge;
        return $this;
    }

    /**
     * Adds as specifiedLogisticsServiceCharge
     *
     * @return self
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\LogisticsServiceChargeType $specifiedLogisticsServiceCharge
     */
    public function addToSpecifiedLogisticsServiceCharge(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\LogisticsServiceChargeType $specifiedLogisticsServiceCharge)
    {
        $this->specifiedLogisticsServiceCharge[] = $specifiedLogisticsServiceCharge;
        return $this;
    }

    /**
     * isset specifiedLogisticsServiceCharge
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetSpecifiedLogisticsServiceCharge($index)
    {
        return isset($this->specifiedLogisticsServiceCharge[$index]);
    }

    /**
     * unset specifiedLogisticsServiceCharge
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetSpecifiedLogisticsServiceCharge($index)
    {
        unset($this->specifiedLogisticsServiceCharge[$index]);
    }

    /**
     * Gets as specifiedLogisticsServiceCharge
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\LogisticsServiceChargeType[]
     */
    public function getSpecifiedLogisticsServiceCharge()
    {
        return $this->specifiedLogisticsServiceCharge;
    }

    /**
     * Sets a new specifiedLogisticsServiceCharge
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\LogisticsServiceChargeType[] $specifiedLogisticsServiceCharge
     * @return self
     */
    public function setSpecifiedLogisticsServiceCharge(array $specifiedLogisticsServiceCharge = null)
    {
        $this->specifiedLogisticsServiceCharge = $specifiedLogisticsServiceCharge;
        return $this;
    }

    /**
     * Adds as specifiedTradePaymentTerms
     *
     * @return self
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePaymentTermsType $specifiedTradePaymentTerms
     */
    public function addToSpecifiedTradePaymentTerms(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePaymentTermsType $specifiedTradePaymentTerms)
    {
        $this->specifiedTradePaymentTerms[] = $specifiedTradePaymentTerms;
        return $this;
    }

    /**
     * isset specifiedTradePaymentTerms
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetSpecifiedTradePaymentTerms($index)
    {
        return isset($this->specifiedTradePaymentTerms[$index]);
    }

    /**
     * unset specifiedTradePaymentTerms
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetSpecifiedTradePaymentTerms($index)
    {
        unset($this->specifiedTradePaymentTerms[$index]);
    }

    /**
     * Gets as specifiedTradePaymentTerms
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePaymentTermsType[]
     */
    public function getSpecifiedTradePaymentTerms()
    {
        return $this->specifiedTradePaymentTerms;
    }

    /**
     * Sets a new specifiedTradePaymentTerms
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePaymentTermsType[] $specifiedTradePaymentTerms
     * @return self
     */
    public function setSpecifiedTradePaymentTerms(array $specifiedTradePaymentTerms = null)
    {
        $this->specifiedTradePaymentTerms = $specifiedTradePaymentTerms;
        return $this;
    }

    /**
     * Gets as specifiedTradeSettlementHeaderMonetarySummation
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeSettlementHeaderMonetarySummationType
     */
    public function getSpecifiedTradeSettlementHeaderMonetarySummation()
    {
        return $this->specifiedTradeSettlementHeaderMonetarySummation;
    }

    /**
     * Sets a new specifiedTradeSettlementHeaderMonetarySummation
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeSettlementHeaderMonetarySummationType $specifiedTradeSettlementHeaderMonetarySummation
     * @return self
     */
    public function setSpecifiedTradeSettlementHeaderMonetarySummation(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeSettlementHeaderMonetarySummationType $specifiedTradeSettlementHeaderMonetarySummation)
    {
        $this->specifiedTradeSettlementHeaderMonetarySummation = $specifiedTradeSettlementHeaderMonetarySummation;
        return $this;
    }

    /**
     * Adds as invoiceReferencedDocument
     *
     * @return self
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $invoiceReferencedDocument
     */
    public function addToInvoiceReferencedDocument(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $invoiceReferencedDocument)
    {
        $this->invoiceReferencedDocument[] = $invoiceReferencedDocument;
        return $this;
    }

    /**
     * isset invoiceReferencedDocument
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetInvoiceReferencedDocument($index)
    {
        return isset($this->invoiceReferencedDocument[$index]);
    }

    /**
     * unset invoiceReferencedDocument
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetInvoiceReferencedDocument($index)
    {
        unset($this->invoiceReferencedDocument[$index]);
    }

    /**
     * Gets as invoiceReferencedDocument
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[]
     */
    public function getInvoiceReferencedDocument()
    {
        return $this->invoiceReferencedDocument;
    }

    /**
     * Sets a new invoiceReferencedDocument
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[] $invoiceReferencedDocument
     * @return self
     */
    public function setInvoiceReferencedDocument(array $invoiceReferencedDocument = null)
    {
        $this->invoiceReferencedDocument = $invoiceReferencedDocument;
        return $this;
    }

    /**
     * Adds as receivableSpecifiedTradeAccountingAccount
     *
     * @return self
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeAccountingAccountType $receivableSpecifiedTradeAccountingAccount
     */
    public function addToReceivableSpecifiedTradeAccountingAccount(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeAccountingAccountType $receivableSpecifiedTradeAccountingAccount)
    {
        $this->receivableSpecifiedTradeAccountingAccount[] = $receivableSpecifiedTradeAccountingAccount;
        return $this;
    }

    /**
     * isset receivableSpecifiedTradeAccountingAccount
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetReceivableSpecifiedTradeAccountingAccount($index)
    {
        return isset($this->receivableSpecifiedTradeAccountingAccount[$index]);
    }

    /**
     * unset receivableSpecifiedTradeAccountingAccount
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetReceivableSpecifiedTradeAccountingAccount($index)
    {
        unset($this->receivableSpecifiedTradeAccountingAccount[$index]);
    }

    /**
     * Gets as receivableSpecifiedTradeAccountingAccount
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeAccountingAccountType[]
     */
    public function getReceivableSpecifiedTradeAccountingAccount()
    {
        return $this->receivableSpecifiedTradeAccountingAccount;
    }

    /**
     * Sets a new receivableSpecifiedTradeAccountingAccount
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeAccountingAccountType[] $receivableSpecifiedTradeAccountingAccount
     * @return self
     */
    public function setReceivableSpecifiedTradeAccountingAccount(array $receivableSpecifiedTradeAccountingAccount = null)
    {
        $this->receivableSpecifiedTradeAccountingAccount = $receivableSpecifiedTradeAccountingAccount;
        return $this;
    }

    /**
     * Adds as specifiedAdvancePayment
     *
     * @return self
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\AdvancePaymentType $specifiedAdvancePayment
     */
    public function addToSpecifiedAdvancePayment(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\AdvancePaymentType $specifiedAdvancePayment)
    {
        $this->specifiedAdvancePayment[] = $specifiedAdvancePayment;
        return $this;
    }

    /**
     * isset specifiedAdvancePayment
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetSpecifiedAdvancePayment($index)
    {
        return isset($this->specifiedAdvancePayment[$index]);
    }

    /**
     * unset specifiedAdvancePayment
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetSpecifiedAdvancePayment($index)
    {
        unset($this->specifiedAdvancePayment[$index]);
    }

    /**
     * Gets as specifiedAdvancePayment
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\AdvancePaymentType[]
     */
    public function getSpecifiedAdvancePayment()
    {
        return $this->specifiedAdvancePayment;
    }

    /**
     * Sets a new specifiedAdvancePayment
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\AdvancePaymentType[] $specifiedAdvancePayment
     * @return self
     */
    public function setSpecifiedAdvancePayment(array $specifiedAdvancePayment = null)
    {
        $this->specifiedAdvancePayment = $specifiedAdvancePayment;
        return $this;
    }
}
