<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing SpecifiedPeriodType
 *
 * XSD Type: SpecifiedPeriodType
 */
class SpecifiedPeriodType
{

    /**
     * @var string $description
     */
    private $description = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\DateTimeType $startDateTime
     */
    private $startDateTime = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\DateTimeType $endDateTime
     */
    private $endDateTime = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\DateTimeType $completeDateTime
     */
    private $completeDateTime = null;

    /**
     * Gets as description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets a new description
     *
     * @param  string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Gets as startDateTime
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\DateTimeType
     */
    public function getStartDateTime()
    {
        return $this->startDateTime;
    }

    /**
     * Sets a new startDateTime
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\DateTimeType $startDateTime
     * @return self
     */
    public function setStartDateTime(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\DateTimeType $startDateTime = null)
    {
        $this->startDateTime = $startDateTime;
        return $this;
    }

    /**
     * Gets as endDateTime
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\DateTimeType
     */
    public function getEndDateTime()
    {
        return $this->endDateTime;
    }

    /**
     * Sets a new endDateTime
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\DateTimeType $endDateTime
     * @return self
     */
    public function setEndDateTime(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\DateTimeType $endDateTime = null)
    {
        $this->endDateTime = $endDateTime;
        return $this;
    }

    /**
     * Gets as completeDateTime
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\DateTimeType
     */
    public function getCompleteDateTime()
    {
        return $this->completeDateTime;
    }

    /**
     * Sets a new completeDateTime
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\DateTimeType $completeDateTime
     * @return self
     */
    public function setCompleteDateTime(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\DateTimeType $completeDateTime = null)
    {
        $this->completeDateTime = $completeDateTime;
        return $this;
    }
}
