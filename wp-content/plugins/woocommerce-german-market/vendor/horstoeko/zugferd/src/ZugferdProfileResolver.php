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

use Throwable;
use SimpleXMLElement;
use MarketPress\German_Market\horstoeko\zugferd\ZugferdProfiles;
use MarketPress\German_Market\horstoeko\zugferd\exception\ZugferdUnknownProfileException;
use MarketPress\German_Market\horstoeko\zugferd\exception\ZugferdUnknownProfileIdException;
use MarketPress\German_Market\horstoeko\zugferd\exception\ZugferdUnknownXmlContentException;

/**
 * Class representing the profile resolver
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class ZugferdProfileResolver
{
    /**
     * Resolve profile id and profile definition by the content of $xmlContent
     *
     * @param  string $xmlContent
     * @return array
     */
    public static function resolve(string $xmlContent): array
    {
        $prevUseInternalErrors = \libxml_use_internal_errors(true);

        try {
            libxml_clear_errors();
            $xmldocument = new SimpleXMLElement($xmlContent);
            $typeelement = $xmldocument->xpath('/rsm:CrossIndustryInvoice/rsm:ExchangedDocumentContext/ram:GuidelineSpecifiedDocumentContextParameter/ram:ID');
            if (libxml_get_last_error()) {
                throw new ZugferdUnknownXmlContentException();
            }
        } catch (Throwable $e) {
            throw new ZugferdUnknownXmlContentException();
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($prevUseInternalErrors);
        }

        if (!is_array($typeelement) || !isset($typeelement[0])) {
            throw new ZugferdUnknownXmlContentException();
        }

        /**
         * @var int $profile
         * @var array $profiledef
         */
        foreach (ZugferdProfiles::PROFILEDEF as $profile => $profiledef) {
            if ($typeelement[0] == $profiledef["contextparameter"]) {
                return [$profile, $profiledef];
            }
        }

        throw new ZugferdUnknownProfileException((string)$typeelement[0]);
    }

    /**
     * Resolve profile id by the content of $xmlContent
     *
     * @param  string $xmlContent
     * @return int
     */
    public static function resolveProfileId(string $xmlContent): int
    {
        return static::resolve($xmlContent)[0];
    }

    /**
     * Resolve profile definition by the content of $xmlContent
     *
     * @param  string $xmlContent
     * @return array
     */
    public static function resolveProfileDef(string $xmlContent): array
    {
        return static::resolve($xmlContent)[1];
    }

    /**
     * Resolve profile id and profile definition by it's id
     *
     * @param  integer $profileId
     * @return array
     */
    public static function resolveById(int $profileId): array
    {
        if (!isset(ZugferdProfiles::PROFILEDEF[$profileId])) {
            throw new ZugferdUnknownProfileIdException($profileId);
        }

        return [$profileId, ZugferdProfiles::PROFILEDEF[$profileId]];
    }

    /**
     * Resolve profile profile definition by it's id
     *
     * @param  int $profileId
     * @return array
     */
    public static function resolveProfileDefById(int $profileId): array
    {
        $resolved = static::resolveById($profileId);

        return $resolved[1];
    }
}
