<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing ExchangedDocumentType
 *
 * XSD Type: ExchangedDocumentType
 */
class ExchangedDocumentType
{

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType $iD
     */
    private $iD = null;

    /**
     * @var string $name
     */
    private $name = null;

    /**
     * @var string $typeCode
     */
    private $typeCode = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\DateTimeType $issueDateTime
     */
    private $issueDateTime = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IndicatorType $copyIndicator
     */
    private $copyIndicator = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType $languageID
     */
    private $languageID = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\NoteType[] $includedNote
     */
    private $includedNote = [
        
    ];

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType $effectiveSpecifiedPeriod
     */
    private $effectiveSpecifiedPeriod = null;

    /**
     * Gets as iD
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function getID()
    {
        return $this->iD;
    }

    /**
     * Sets a new iD
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType $iD
     * @return self
     */
    public function setID(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType $iD)
    {
        $this->iD = $iD;
        return $this;
    }

    /**
     * Gets as name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a new name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * Gets as issueDateTime
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\DateTimeType
     */
    public function getIssueDateTime()
    {
        return $this->issueDateTime;
    }

    /**
     * Sets a new issueDateTime
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\DateTimeType $issueDateTime
     * @return self
     */
    public function setIssueDateTime(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\DateTimeType $issueDateTime)
    {
        $this->issueDateTime = $issueDateTime;
        return $this;
    }

    /**
     * Gets as copyIndicator
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IndicatorType
     */
    public function getCopyIndicator()
    {
        return $this->copyIndicator;
    }

    /**
     * Sets a new copyIndicator
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IndicatorType $copyIndicator
     * @return self
     */
    public function setCopyIndicator(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IndicatorType $copyIndicator = null)
    {
        $this->copyIndicator = $copyIndicator;
        return $this;
    }

    /**
     * Gets as languageID
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function getLanguageID()
    {
        return $this->languageID;
    }

    /**
     * Sets a new languageID
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType $languageID
     * @return self
     */
    public function setLanguageID(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType $languageID = null)
    {
        $this->languageID = $languageID;
        return $this;
    }

    /**
     * Adds as includedNote
     *
     * @return self
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\NoteType $includedNote
     */
    public function addToIncludedNote(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\NoteType $includedNote)
    {
        $this->includedNote[] = $includedNote;
        return $this;
    }

    /**
     * isset includedNote
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetIncludedNote($index)
    {
        return isset($this->includedNote[$index]);
    }

    /**
     * unset includedNote
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetIncludedNote($index)
    {
        unset($this->includedNote[$index]);
    }

    /**
     * Gets as includedNote
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\NoteType[]
     */
    public function getIncludedNote()
    {
        return $this->includedNote;
    }

    /**
     * Sets a new includedNote
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\NoteType[] $includedNote
     * @return self
     */
    public function setIncludedNote(array $includedNote = null)
    {
        $this->includedNote = $includedNote;
        return $this;
    }

    /**
     * Gets as effectiveSpecifiedPeriod
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType
     */
    public function getEffectiveSpecifiedPeriod()
    {
        return $this->effectiveSpecifiedPeriod;
    }

    /**
     * Sets a new effectiveSpecifiedPeriod
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType $effectiveSpecifiedPeriod
     * @return self
     */
    public function setEffectiveSpecifiedPeriod(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType $effectiveSpecifiedPeriod = null)
    {
        $this->effectiveSpecifiedPeriod = $effectiveSpecifiedPeriod;
        return $this;
    }
}
