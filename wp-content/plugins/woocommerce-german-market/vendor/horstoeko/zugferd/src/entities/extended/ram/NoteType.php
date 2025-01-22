<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing NoteType
 *
 * XSD Type: NoteType
 */
class NoteType
{

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\CodeType $contentCode
     */
    private $contentCode = null;

    /**
     * @var string $content
     */
    private $content = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\CodeType $subjectCode
     */
    private $subjectCode = null;

    /**
     * Gets as contentCode
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\CodeType
     */
    public function getContentCode()
    {
        return $this->contentCode;
    }

    /**
     * Sets a new contentCode
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\CodeType $contentCode
     * @return self
     */
    public function setContentCode(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\CodeType $contentCode = null)
    {
        $this->contentCode = $contentCode;
        return $this;
    }

    /**
     * Gets as content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets a new content
     *
     * @param  string $content
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Gets as subjectCode
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\CodeType
     */
    public function getSubjectCode()
    {
        return $this->subjectCode;
    }

    /**
     * Sets a new subjectCode
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\CodeType $subjectCode
     * @return self
     */
    public function setSubjectCode(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\CodeType $subjectCode = null)
    {
        $this->subjectCode = $subjectCode;
        return $this;
    }


}

