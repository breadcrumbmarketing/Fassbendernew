<?php
/**
 * @license MIT
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradePartyType
 *
 * XSD Type: TradePartyType
 */
class TradePartyType
{

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType[] $iD
     */
    private $iD = [
        
    ];

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType[] $globalID
     */
    private $globalID = [
        
    ];

    /**
     * @var string $name
     */
    private $name = null;

    /**
     * @var string $roleCode
     */
    private $roleCode = null;

    /**
     * @var string $description
     */
    private $description = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\LegalOrganizationType $specifiedLegalOrganization
     */
    private $specifiedLegalOrganization = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeContactType[] $definedTradeContact
     */
    private $definedTradeContact = [
        
    ];

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeAddressType $postalTradeAddress
     */
    private $postalTradeAddress = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\UniversalCommunicationType $uRIUniversalCommunication
     */
    private $uRIUniversalCommunication = null;

    /**
     * @var \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TaxRegistrationType[] $specifiedTaxRegistration
     */
    private $specifiedTaxRegistration = [
        
    ];

    /**
     * Adds as iD
     *
     * @return self
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType $iD
     */
    public function addToID(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType $iD)
    {
        $this->iD[] = $iD;
        return $this;
    }

    /**
     * isset iD
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetID($index)
    {
        return isset($this->iD[$index]);
    }

    /**
     * unset iD
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetID($index)
    {
        unset($this->iD[$index]);
    }

    /**
     * Gets as iD
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType[]
     */
    public function getID()
    {
        return $this->iD;
    }

    /**
     * Sets a new iD
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType[] $iD
     * @return self
     */
    public function setID(array $iD = null)
    {
        $this->iD = $iD;
        return $this;
    }

    /**
     * Adds as globalID
     *
     * @return self
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType $globalID
     */
    public function addToGlobalID(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType $globalID)
    {
        $this->globalID[] = $globalID;
        return $this;
    }

    /**
     * isset globalID
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetGlobalID($index)
    {
        return isset($this->globalID[$index]);
    }

    /**
     * unset globalID
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetGlobalID($index)
    {
        unset($this->globalID[$index]);
    }

    /**
     * Gets as globalID
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType[]
     */
    public function getGlobalID()
    {
        return $this->globalID;
    }

    /**
     * Sets a new globalID
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\udt\IDType[] $globalID
     * @return self
     */
    public function setGlobalID(array $globalID = null)
    {
        $this->globalID = $globalID;
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
     * Gets as roleCode
     *
     * @return string
     */
    public function getRoleCode()
    {
        return $this->roleCode;
    }

    /**
     * Sets a new roleCode
     *
     * @param  string $roleCode
     * @return self
     */
    public function setRoleCode($roleCode)
    {
        $this->roleCode = $roleCode;
        return $this;
    }

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
     * Gets as specifiedLegalOrganization
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\LegalOrganizationType
     */
    public function getSpecifiedLegalOrganization()
    {
        return $this->specifiedLegalOrganization;
    }

    /**
     * Sets a new specifiedLegalOrganization
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\LegalOrganizationType $specifiedLegalOrganization
     * @return self
     */
    public function setSpecifiedLegalOrganization(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\LegalOrganizationType $specifiedLegalOrganization = null)
    {
        $this->specifiedLegalOrganization = $specifiedLegalOrganization;
        return $this;
    }

    /**
     * Adds as definedTradeContact
     *
     * @return self
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeContactType $definedTradeContact
     */
    public function addToDefinedTradeContact(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeContactType $definedTradeContact)
    {
        $this->definedTradeContact[] = $definedTradeContact;
        return $this;
    }

    /**
     * isset definedTradeContact
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetDefinedTradeContact($index)
    {
        return isset($this->definedTradeContact[$index]);
    }

    /**
     * unset definedTradeContact
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetDefinedTradeContact($index)
    {
        unset($this->definedTradeContact[$index]);
    }

    /**
     * Gets as definedTradeContact
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeContactType[]
     */
    public function getDefinedTradeContact()
    {
        return $this->definedTradeContact;
    }

    /**
     * Sets a new definedTradeContact
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeContactType[] $definedTradeContact
     * @return self
     */
    public function setDefinedTradeContact(array $definedTradeContact = null)
    {
        $this->definedTradeContact = $definedTradeContact;
        return $this;
    }

    /**
     * Gets as postalTradeAddress
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeAddressType
     */
    public function getPostalTradeAddress()
    {
        return $this->postalTradeAddress;
    }

    /**
     * Sets a new postalTradeAddress
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeAddressType $postalTradeAddress
     * @return self
     */
    public function setPostalTradeAddress(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TradeAddressType $postalTradeAddress = null)
    {
        $this->postalTradeAddress = $postalTradeAddress;
        return $this;
    }

    /**
     * Gets as uRIUniversalCommunication
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\UniversalCommunicationType
     */
    public function getURIUniversalCommunication()
    {
        return $this->uRIUniversalCommunication;
    }

    /**
     * Sets a new uRIUniversalCommunication
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\UniversalCommunicationType $uRIUniversalCommunication
     * @return self
     */
    public function setURIUniversalCommunication(?\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\UniversalCommunicationType $uRIUniversalCommunication = null)
    {
        $this->uRIUniversalCommunication = $uRIUniversalCommunication;
        return $this;
    }

    /**
     * Adds as specifiedTaxRegistration
     *
     * @return self
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TaxRegistrationType $specifiedTaxRegistration
     */
    public function addToSpecifiedTaxRegistration(\MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TaxRegistrationType $specifiedTaxRegistration)
    {
        $this->specifiedTaxRegistration[] = $specifiedTaxRegistration;
        return $this;
    }

    /**
     * isset specifiedTaxRegistration
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetSpecifiedTaxRegistration($index)
    {
        return isset($this->specifiedTaxRegistration[$index]);
    }

    /**
     * unset specifiedTaxRegistration
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetSpecifiedTaxRegistration($index)
    {
        unset($this->specifiedTaxRegistration[$index]);
    }

    /**
     * Gets as specifiedTaxRegistration
     *
     * @return \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TaxRegistrationType[]
     */
    public function getSpecifiedTaxRegistration()
    {
        return $this->specifiedTaxRegistration;
    }

    /**
     * Sets a new specifiedTaxRegistration
     *
     * @param  \MarketPress\German_Market\horstoeko\zugferd\entities\extended\ram\TaxRegistrationType[] $specifiedTaxRegistration
     * @return self
     */
    public function setSpecifiedTaxRegistration(array $specifiedTaxRegistration = null)
    {
        $this->specifiedTaxRegistration = $specifiedTaxRegistration;
        return $this;
    }
}
