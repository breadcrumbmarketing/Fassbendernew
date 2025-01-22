<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\horstoeko\zugferd\entities\basicwl\ram;

/**
 * Class representing SpecifiedPeriodType
 *
 * XSD Type: SpecifiedPeriodType
 */
class SpecifiedPeriodType
{

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\basicwl\udt\DateTimeType $startDateTime
     */
    private $startDateTime = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\basicwl\udt\DateTimeType $endDateTime
     */
    private $endDateTime = null;

    /**
     * Gets as startDateTime
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\basicwl\udt\DateTimeType
     */
    public function getStartDateTime()
    {
        return $this->startDateTime;
    }

    /**
     * Sets a new startDateTime
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\basicwl\udt\DateTimeType $startDateTime
     * @return self
     */
    public function setStartDateTime(?\MarketPress\German_Market\horstoeko\zugferd\entities\basicwl\udt\DateTimeType $startDateTime = null)
    {
        $this->startDateTime = $startDateTime;
        return $this;
    }

    /**
     * Gets as endDateTime
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\basicwl\udt\DateTimeType
     */
    public function getEndDateTime()
    {
        return $this->endDateTime;
    }

    /**
     * Sets a new endDateTime
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\basicwl\udt\DateTimeType $endDateTime
     * @return self
     */
    public function setEndDateTime(?\MarketPress\German_Market\horstoeko\zugferd\entities\basicwl\udt\DateTimeType $endDateTime = null)
    {
        $this->endDateTime = $endDateTime;
        return $this;
    }
}
