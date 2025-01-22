<?php

/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\horstoeko\zugferd;

use MarketPress\German_Market\horstoeko\zugferd\ZugferdDocumentBuilder;
use MarketPress\German_Market\horstoeko\zugferd\ZugferdDocumentPdfBuilderAbstract;
use MarketPress\German_Market\horstoeko\zugferd\exception\ZugferdFileNotFoundException;

/**
 * Class representing the facillity adding XML data from ZugferdDocumentBuilder
 * to an existing PDF with conversion to PDF/A
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class ZugferdDocumentPdfBuilder extends ZugferdDocumentPdfBuilderAbstract
{
    /**
     * Internal reference to the xml builder instance
     *
     * @var ZugferdDocumentBuilder
     */
    private $documentBuilder = null;

    /**
     * Cached XML data
     *
     * @var string
     */
    private $xmlDataCache = "";

    /**
     * @see self::__construct
     */
    public static function fromPdfFile(ZugferdDocumentBuilder $documentBuilder, string $pdfFileName): self
    {
        if (!is_file($pdfFileName)) {
            throw new ZugferdFileNotFoundException("The given PDF file does not exist.");
        }

        return new self($documentBuilder, $pdfFileName);
    }

    /**
     * @see self::__construct
     */
    public static function fromPdfString(ZugferdDocumentBuilder $documentBuilder, string $pdfContent): self
    {
        return new self($documentBuilder, $pdfContent);
    }

    /**
     * Constructor
     *
     * @param ZugferdDocumentBuilder $documentBuilder
     * The instance of the document builder. Needed to get the XML data
     * @param string                 $pdfData
     * The full filename or a string containing the binary pdf data. This
     * is the original PDF (e.g. created by a ERP system)
     */
    public function __construct(ZugferdDocumentBuilder $documentBuilder, string $pdfData)
    {
        $this->documentBuilder = $documentBuilder;

        parent::__construct($pdfData);
    }

    /**
     * @inheritDoc
     */
    protected function getXmlContent(): string
    {
        if ($this->xmlDataCache) {
            return $this->xmlDataCache;
        }

        $this->xmlDataCache = $this->documentBuilder->getContent();

        return $this->xmlDataCache;
    }

    /**
     * @inheritDoc
     */
    protected function getXmlAttachmentFilename(): string
    {
        return $this->documentBuilder->getProfileDefinitionParameter('attachmentfilename');
    }

    /**
     * @inheritDoc
     */
    protected function getXmlAttachmentXmpName(): string
    {
        return $this->documentBuilder->getProfileDefinitionParameter("xmpname");
    }
}
