<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing LineTradeAgreementType
 *
 * XSD Type: LineTradeAgreementType
 */
class LineTradeAgreementType
{

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $sellerOrderReferencedDocument
     */
    private $sellerOrderReferencedDocument = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     */
    private $buyerOrderReferencedDocument = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $quotationReferencedDocument
     */
    private $quotationReferencedDocument = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $contractReferencedDocument
     */
    private $contractReferencedDocument = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[] $additionalReferencedDocument
     */
    private $additionalReferencedDocument = [
        
    ];

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePriceType $grossPriceProductTradePrice
     */
    private $grossPriceProductTradePrice = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePriceType $netPriceProductTradePrice
     */
    private $netPriceProductTradePrice = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[] $ultimateCustomerOrderReferencedDocument
     */
    private $ultimateCustomerOrderReferencedDocument = [
        
    ];

    /**
     * Gets as sellerOrderReferencedDocument
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType
     */
    public function getSellerOrderReferencedDocument()
    {
        return $this->sellerOrderReferencedDocument;
    }

    /**
     * Sets a new sellerOrderReferencedDocument
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $sellerOrderReferencedDocument
     * @return self
     */
    public function setSellerOrderReferencedDocument(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $sellerOrderReferencedDocument = null)
    {
        $this->sellerOrderReferencedDocument = $sellerOrderReferencedDocument;
        return $this;
    }

    /**
     * Gets as buyerOrderReferencedDocument
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType
     */
    public function getBuyerOrderReferencedDocument()
    {
        return $this->buyerOrderReferencedDocument;
    }

    /**
     * Sets a new buyerOrderReferencedDocument
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     * @return self
     */
    public function setBuyerOrderReferencedDocument(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $buyerOrderReferencedDocument = null)
    {
        $this->buyerOrderReferencedDocument = $buyerOrderReferencedDocument;
        return $this;
    }

    /**
     * Gets as quotationReferencedDocument
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType
     */
    public function getQuotationReferencedDocument()
    {
        return $this->quotationReferencedDocument;
    }

    /**
     * Sets a new quotationReferencedDocument
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $quotationReferencedDocument
     * @return self
     */
    public function setQuotationReferencedDocument(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $quotationReferencedDocument = null)
    {
        $this->quotationReferencedDocument = $quotationReferencedDocument;
        return $this;
    }

    /**
     * Gets as contractReferencedDocument
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType
     */
    public function getContractReferencedDocument()
    {
        return $this->contractReferencedDocument;
    }

    /**
     * Sets a new contractReferencedDocument
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $contractReferencedDocument
     * @return self
     */
    public function setContractReferencedDocument(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $contractReferencedDocument = null)
    {
        $this->contractReferencedDocument = $contractReferencedDocument;
        return $this;
    }

    /**
     * Adds as additionalReferencedDocument
     *
     * @return self
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $additionalReferencedDocument
     */
    public function addToAdditionalReferencedDocument(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $additionalReferencedDocument)
    {
        $this->additionalReferencedDocument[] = $additionalReferencedDocument;
        return $this;
    }

    /**
     * isset additionalReferencedDocument
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetAdditionalReferencedDocument($index)
    {
        return isset($this->additionalReferencedDocument[$index]);
    }

    /**
     * unset additionalReferencedDocument
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetAdditionalReferencedDocument($index)
    {
        unset($this->additionalReferencedDocument[$index]);
    }

    /**
     * Gets as additionalReferencedDocument
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[]
     */
    public function getAdditionalReferencedDocument()
    {
        return $this->additionalReferencedDocument;
    }

    /**
     * Sets a new additionalReferencedDocument
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[] $additionalReferencedDocument
     * @return self
     */
    public function setAdditionalReferencedDocument(array $additionalReferencedDocument = null)
    {
        $this->additionalReferencedDocument = $additionalReferencedDocument;
        return $this;
    }

    /**
     * Gets as grossPriceProductTradePrice
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePriceType
     */
    public function getGrossPriceProductTradePrice()
    {
        return $this->grossPriceProductTradePrice;
    }

    /**
     * Sets a new grossPriceProductTradePrice
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePriceType $grossPriceProductTradePrice
     * @return self
     */
    public function setGrossPriceProductTradePrice(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePriceType $grossPriceProductTradePrice = null)
    {
        $this->grossPriceProductTradePrice = $grossPriceProductTradePrice;
        return $this;
    }

    /**
     * Gets as netPriceProductTradePrice
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePriceType
     */
    public function getNetPriceProductTradePrice()
    {
        return $this->netPriceProductTradePrice;
    }

    /**
     * Sets a new netPriceProductTradePrice
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePriceType $netPriceProductTradePrice
     * @return self
     */
    public function setNetPriceProductTradePrice(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradePriceType $netPriceProductTradePrice)
    {
        $this->netPriceProductTradePrice = $netPriceProductTradePrice;
        return $this;
    }

    /**
     * Adds as ultimateCustomerOrderReferencedDocument
     *
     * @return self
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $ultimateCustomerOrderReferencedDocument
     */
    public function addToUltimateCustomerOrderReferencedDocument(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $ultimateCustomerOrderReferencedDocument)
    {
        $this->ultimateCustomerOrderReferencedDocument[] = $ultimateCustomerOrderReferencedDocument;
        return $this;
    }

    /**
     * isset ultimateCustomerOrderReferencedDocument
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetUltimateCustomerOrderReferencedDocument($index)
    {
        return isset($this->ultimateCustomerOrderReferencedDocument[$index]);
    }

    /**
     * unset ultimateCustomerOrderReferencedDocument
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetUltimateCustomerOrderReferencedDocument($index)
    {
        unset($this->ultimateCustomerOrderReferencedDocument[$index]);
    }

    /**
     * Gets as ultimateCustomerOrderReferencedDocument
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[]
     */
    public function getUltimateCustomerOrderReferencedDocument()
    {
        return $this->ultimateCustomerOrderReferencedDocument;
    }

    /**
     * Sets a new ultimateCustomerOrderReferencedDocument
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[] $ultimateCustomerOrderReferencedDocument
     * @return self
     */
    public function setUltimateCustomerOrderReferencedDocument(array $ultimateCustomerOrderReferencedDocument = null)
    {
        $this->ultimateCustomerOrderReferencedDocument = $ultimateCustomerOrderReferencedDocument;
        return $this;
    }
}
