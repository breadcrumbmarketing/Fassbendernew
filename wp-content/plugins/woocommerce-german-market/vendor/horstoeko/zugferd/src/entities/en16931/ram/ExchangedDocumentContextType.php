<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing ExchangedDocumentContextType
 *
 * XSD Type: ExchangedDocumentContextType
 */
class ExchangedDocumentContextType
{

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram\DocumentContextParameterType $businessProcessSpecifiedDocumentContextParameter
     */
    private $businessProcessSpecifiedDocumentContextParameter = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram\DocumentContextParameterType $guidelineSpecifiedDocumentContextParameter
     */
    private $guidelineSpecifiedDocumentContextParameter = null;

    /**
     * Gets as businessProcessSpecifiedDocumentContextParameter
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram\DocumentContextParameterType
     */
    public function getBusinessProcessSpecifiedDocumentContextParameter()
    {
        return $this->businessProcessSpecifiedDocumentContextParameter;
    }

    /**
     * Sets a new businessProcessSpecifiedDocumentContextParameter
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram\DocumentContextParameterType $businessProcessSpecifiedDocumentContextParameter
     * @return self
     */
    public function setBusinessProcessSpecifiedDocumentContextParameter(?\MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram\DocumentContextParameterType $businessProcessSpecifiedDocumentContextParameter = null)
    {
        $this->businessProcessSpecifiedDocumentContextParameter = $businessProcessSpecifiedDocumentContextParameter;
        return $this;
    }

    /**
     * Gets as guidelineSpecifiedDocumentContextParameter
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram\DocumentContextParameterType
     */
    public function getGuidelineSpecifiedDocumentContextParameter()
    {
        return $this->guidelineSpecifiedDocumentContextParameter;
    }

    /**
     * Sets a new guidelineSpecifiedDocumentContextParameter
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram\DocumentContextParameterType $guidelineSpecifiedDocumentContextParameter
     * @return self
     */
    public function setGuidelineSpecifiedDocumentContextParameter(\MarketPress\German_Market\horstoeko\zugferd\entities\en16931\ram\DocumentContextParameterType $guidelineSpecifiedDocumentContextParameter)
    {
        $this->guidelineSpecifiedDocumentContextParameter = $guidelineSpecifiedDocumentContextParameter;
        return $this;
    }
}
