<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing LineTradeAgreementType
 *
 * XSD Type: LineTradeAgreementType
 */
class LineTradeAgreementType
{

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     */
    private $buyerOrderReferencedDocument = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram\TradePriceType $grossPriceProductTradePrice
     */
    private $grossPriceProductTradePrice = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram\TradePriceType $netPriceProductTradePrice
     */
    private $netPriceProductTradePrice = null;

    /**
     * Gets as buyerOrderReferencedDocument
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType
     */
    public function getBuyerOrderReferencedDocument()
    {
        return $this->buyerOrderReferencedDocument;
    }

    /**
     * Sets a new buyerOrderReferencedDocument
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     * @return self
     */
    public function setBuyerOrderReferencedDocument(?\MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $buyerOrderReferencedDocument = null)
    {
        $this->buyerOrderReferencedDocument = $buyerOrderReferencedDocument;
        return $this;
    }

    /**
     * Gets as grossPriceProductTradePrice
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram\TradePriceType
     */
    public function getGrossPriceProductTradePrice()
    {
        return $this->grossPriceProductTradePrice;
    }

    /**
     * Sets a new grossPriceProductTradePrice
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram\TradePriceType $grossPriceProductTradePrice
     * @return self
     */
    public function setGrossPriceProductTradePrice(?\MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram\TradePriceType $grossPriceProductTradePrice = null)
    {
        $this->grossPriceProductTradePrice = $grossPriceProductTradePrice;
        return $this;
    }

    /**
     * Gets as netPriceProductTradePrice
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram\TradePriceType
     */
    public function getNetPriceProductTradePrice()
    {
        return $this->netPriceProductTradePrice;
    }

    /**
     * Sets a new netPriceProductTradePrice
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram\TradePriceType $netPriceProductTradePrice
     * @return self
     */
    public function setNetPriceProductTradePrice(\MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram\TradePriceType $netPriceProductTradePrice)
    {
        $this->netPriceProductTradePrice = $netPriceProductTradePrice;
        return $this;
    }
}
