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

use MarketPress\German_Market\horstoeko\stringmanagement\PathUtils;
use MarketPress\German_Market\horstoeko\zugferd\ZugferdSettings;
use MarketPress\German_Market\Symfony\Component\Validator\ConstraintViolationListInterface;
use MarketPress\German_Market\Symfony\Component\Validator\Validation;

/**
 * Class representing the document validator for incoming documents
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class ZugferdDocumentValidator
{
    /**
     * The invoice document reference
     *
     * @var ZugferdDocument
     */
    private $document;

    /**
     * The validator instance
     *
     * @var \MarketPress\German_Market\Symfony\Component\Validator\Validator\ValidatorInterface;
     */
    private $validator = null;

    /**
     * Constructor
     *
     * @param ZugferdDocument $document
     */
    public function __construct(ZugferdDocument $document)
    {
        $this->document = $document;
        $this->initValidator();
    }

    /**
     * Perform the validation of the document
     *
     * @return ConstraintViolationListInterface
     */
    public function validateDocument(): ConstraintViolationListInterface
    {
        return $this->validator->validate($this->document->getInvoiceObject(), null, ['xsd_rules']);
    }

    /**
     * Initialize the internal validator object
     *
     * @return void
     */
    private function initValidator(): void
    {
        $validatorBuilder = Validation::createValidatorBuilder();

        $validatorYamlFiles = PathUtils::combinePathWithFile(
            PathUtils::combineAllPaths(
                ZugferdSettings::getValidationDirectory(),
                $this->document->getProfileDefinitionParameter('name')
            ),
            '*.yml'
        );

        $validatorYamlFiles = $this->globRecursive($validatorYamlFiles);

        foreach ($validatorYamlFiles as $validatorYamlFile) {
            $validatorBuilder->addYamlMapping($validatorYamlFile);
        }

        $this->validator = $validatorBuilder->getValidator();
    }

    /**
     * Helper for find all files by pattern
     *
     * @param  string  $pattern
     * @param  integer $flags
     * @return array
     */
    private function globRecursive(string $pattern, int $flags = 0): array
    {
        $files = glob($pattern, $flags);

        foreach (glob(dirname($pattern) . '/*', GLOB_ONLYDIR | GLOB_NOSORT) as $dir) {
            $files = array_merge($files, $this->globRecursive($dir . '/' . basename($pattern), $flags));
        }

        return $files;
    }
}
