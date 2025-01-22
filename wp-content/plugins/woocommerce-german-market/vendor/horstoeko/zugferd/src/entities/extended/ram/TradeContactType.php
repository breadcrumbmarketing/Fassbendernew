<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradeContactType
 *
 * XSD Type: TradeContactType
 */
class TradeContactType
{

    /**
     * @var string $personName
     */
    private $personName = null;

    /**
     * @var string $departmentName
     */
    private $departmentName = null;

    /**
     * @var string $typeCode
     */
    private $typeCode = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\UniversalCommunicationType $telephoneUniversalCommunication
     */
    private $telephoneUniversalCommunication = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\UniversalCommunicationType $faxUniversalCommunication
     */
    private $faxUniversalCommunication = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\UniversalCommunicationType $emailURIUniversalCommunication
     */
    private $emailURIUniversalCommunication = null;

    /**
     * Gets as personName
     *
     * @return string
     */
    public function getPersonName()
    {
        return $this->personName;
    }

    /**
     * Sets a new personName
     *
     * @param  string $personName
     * @return self
     */
    public function setPersonName($personName)
    {
        $this->personName = $personName;
        return $this;
    }

    /**
     * Gets as departmentName
     *
     * @return string
     */
    public function getDepartmentName()
    {
        return $this->departmentName;
    }

    /**
     * Sets a new departmentName
     *
     * @param  string $departmentName
     * @return self
     */
    public function setDepartmentName($departmentName)
    {
        $this->departmentName = $departmentName;
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
     * Gets as telephoneUniversalCommunication
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\UniversalCommunicationType
     */
    public function getTelephoneUniversalCommunication()
    {
        return $this->telephoneUniversalCommunication;
    }

    /**
     * Sets a new telephoneUniversalCommunication
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\UniversalCommunicationType $telephoneUniversalCommunication
     * @return self
     */
    public function setTelephoneUniversalCommunication(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\UniversalCommunicationType $telephoneUniversalCommunication = null)
    {
        $this->telephoneUniversalCommunication = $telephoneUniversalCommunication;
        return $this;
    }

    /**
     * Gets as faxUniversalCommunication
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\UniversalCommunicationType
     */
    public function getFaxUniversalCommunication()
    {
        return $this->faxUniversalCommunication;
    }

    /**
     * Sets a new faxUniversalCommunication
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\UniversalCommunicationType $faxUniversalCommunication
     * @return self
     */
    public function setFaxUniversalCommunication(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\UniversalCommunicationType $faxUniversalCommunication = null)
    {
        $this->faxUniversalCommunication = $faxUniversalCommunication;
        return $this;
    }

    /**
     * Gets as emailURIUniversalCommunication
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\UniversalCommunicationType
     */
    public function getEmailURIUniversalCommunication()
    {
        return $this->emailURIUniversalCommunication;
    }

    /**
     * Sets a new emailURIUniversalCommunication
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\UniversalCommunicationType $emailURIUniversalCommunication
     * @return self
     */
    public function setEmailURIUniversalCommunication(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\UniversalCommunicationType $emailURIUniversalCommunication = null)
    {
        $this->emailURIUniversalCommunication = $emailURIUniversalCommunication;
        return $this;
    }
}
