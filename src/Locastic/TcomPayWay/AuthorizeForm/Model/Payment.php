<?php

namespace Locastic\TcomPayWay\AuthorizeForm\Model;

use Locastic\TcomPayWay\AuthorizeForm\Helpers\SignatureGenerator;

/**
 * This model is used for preparing standard model of payment (athorize-form)
 *
 * Class Payment
 * @package Locastic\TcomPayWay\AuthorizeForm\Model
 */
class Payment
{
    /**
     * @var int
     */
    protected $pgwShopId;

    /**
     * @var string
     */
    protected $secretKey;

    /**
     * @var string
     */
    protected $pgwOrderId;

    /**
     * Amount is shown in cents
     *
     * @var int
     */
    protected $pgwAmount;

    /**
     * @var int
     */
    protected $pgwAuthorizationType;

    /**
     * @var string
     */
    protected $pgwAuthorizationToken;

    /**
     * @var string
     */
    protected $pgwLanguage;

    /**
     * GET or POST
     *
     * @var string
     */
    protected $pgwReturnMethod;

    /**
     * @var string
     */
    protected $pgwSuccessUrl;

    /**
     * @var string
     */
    protected $pgwFailureUrl;

    /**
     * @var string
     */
    protected $pgwFirstName;

    /**
     * @var string
     */
    protected $pgwLastName;

    /**
     * @var string
     */
    protected $pgwStreet;

    /**
     * @var string
     */
    protected $pgwCity;

    /**
     * @var string
     */
    protected $pgwPostCode;

    /**
     * @var string
     */
    protected $pgwCountry;

    /**
     * @var string
     */
    protected $pgwTelephone;

    /**
     * @var string
     */
    protected $pgwEmail;

    /**
     * @var string
     */
    protected $pgwmerchantData;

    /**
     * @var string
     */
    protected $pgwOrderInfo;

    /**
     * @var string
     */
    protected $pgwOrderItems;

    /**
     * @var string
     */
    protected $pgwDisableInstallments;

    /**
     * @var string
     */
    protected $pgwSignature;

    /**
     * @param string $pgwShopId
     * @param string $secretKey
     * @param string $pgwOrderId
     * @param string $pgwAmount
     * @param string $pgwAuthorizationType
     * @param string $pgwSuccessUrl
     * @param string $pgwFailureUrl
     */
    public function __construct($pgwShopId, $secretKey, $pgwOrderId, $pgwAmount, $pgwAuthorizationType, $pgwSuccessUrl, $pgwFailureUrl)
    {
        $this->pgwShopId = $pgwShopId;
        $this->secretKey = $secretKey;
        $this->pgwOrderId = $pgwOrderId;
        $this->pgwAmount = $pgwAmount;
        $this->pgwAuthorizationType = $pgwAuthorizationType;
        $this->pgwSuccessUrl = $pgwSuccessUrl;
        $this->pgwFailureUrl = $pgwFailureUrl;
    }

    /**
     * @return string
     */
    public function getPgwOrderItems()
    {
        return $this->pgwOrderItems;
    }

    /**
     * @param string $pgwOrderItems
     */
    public function setPgwOrderItems($pgwOrderItems)
    {
        $this->pgwOrderItems = $pgwOrderItems;
    }

    /**
     * @return int
     */
    public function getPgwShopId()
    {
        return $this->pgwShopId;
    }

    /**
     * @param int $pgwShopId
     */
    public function setPgwShopId($pgwShopId)
    {
        $this->pgwShopId = $pgwShopId;
    }

    /**
     * @return string
     */
    public function getPgwOrderId()
    {
        return $this->pgwOrderId;
    }

    /**
     * @param string $pgwOrderId
     */
    public function setPgwOrderId($pgwOrderId)
    {
        $this->pgwOrderId = $pgwOrderId;
    }

    /**
     * @return int
     */
    public function getPgwAmount()
    {
        return $this->pgwAmount;
    }

    /**
     * @param int $pgwAmount
     */
    public function setPgwAmount($pgwAmount)
    {
        $this->pgwAmount = $pgwAmount;
    }

    /**
     * @return int
     */
    public function getPgwAuthorizationType()
    {
        return $this->pgwAuthorizationType;
    }

    /**
     * @param int $pgwAuthorizationType
     */
    public function setPgwAuthorizationType($pgwAuthorizationType)
    {
        $this->pgwAuthorizationType = $pgwAuthorizationType;
    }

    /**
     * @return string
     */
    public function getPgwAuthorizationToken()
    {
        return $this->pgwAuthorizationToken;
    }

    /**
     * @param string $pgwAuthorizationToken
     */
    public function setPgwAuthorizationToken($pgwAuthorizationToken)
    {
        $this->pgwAuthorizationToken = $pgwAuthorizationToken;
    }

    /**
     * @return string
     */
    public function getPgwLanguage()
    {
        return $this->pgwLanguage;
    }

    /**
     * @param string $pgwLanguage
     */
    public function setPgwLanguage($pgwLanguage)
    {
        $this->pgwLanguage = $pgwLanguage;
    }

    /**
     * @return string
     */
    public function getPgwReturnMethod()
    {
        return $this->pgwReturnMethod;
    }

    /**
     * @param string $pgwReturnMethod
     */
    public function setPgwReturnMethod($pgwReturnMethod)
    {
        $this->pgwReturnMethod = $pgwReturnMethod;
    }

    /**
     * @return string
     */
    public function getPgwSuccessUrl()
    {
        return $this->pgwSuccessUrl;
    }

    /**
     * @param string $pgwSuccessUrl
     */
    public function setPgwSuccessUrl($pgwSuccessUrl)
    {
        $this->pgwSuccessUrl = $pgwSuccessUrl;
    }

    /**
     * @return string
     */
    public function getPgwFailureUrl()
    {
        return $this->pgwFailureUrl;
    }

    /**
     * @param string $pgwFailureUrl
     */
    public function setPgwFailureUrl($pgwFailureUrl)
    {
        $this->pgwFailureUrl = $pgwFailureUrl;
    }

    /**
     * @return string
     */
    public function getPgwFirstName()
    {
        return $this->pgwFirstName;
    }

    /**
     * @param string $pgwFirstName
     */
    public function setPgwFirstName($pgwFirstName)
    {
        $this->pgwFirstName = $pgwFirstName;
    }

    /**
     * @return string
     */
    public function getPgwLastName()
    {
        return $this->pgwLastName;
    }

    /**
     * @param string $pgwLastName
     */
    public function setPgwLastName($pgwLastName)
    {
        $this->pgwLastName = $pgwLastName;
    }

    /**
     * @return string
     */
    public function getPgwStreet()
    {
        return $this->pgwStreet;
    }

    /**
     * @param string $pgwStreet
     */
    public function setPgwStreet($pgwStreet)
    {
        $this->pgwStreet = $pgwStreet;
    }

    /**
     * @return string
     */
    public function getPgwCity()
    {
        return $this->pgwCity;
    }

    /**
     * @param string $pgwCity
     */
    public function setPgwCity($pgwCity)
    {
        $this->pgwCity = $pgwCity;
    }

    /**
     * @return string
     */
    public function getPgwPostCode()
    {
        return $this->pgwPostCode;
    }

    /**
     * @param string $pgwPostCode
     */
    public function setPgwPostCode($pgwPostCode)
    {
        $this->pgwPostCode = $pgwPostCode;
    }

    /**
     * @return string
     */
    public function getPgwCountry()
    {
        return $this->pgwCountry;
    }

    /**
     * @param string $pgwCountry
     */
    public function setPgwCountry($pgwCountry)
    {
        $this->pgwCountry = $pgwCountry;
    }

    /**
     * @return string
     */
    public function getPgwTelephone()
    {
        return $this->pgwTelephone;
    }

    /**
     * @param string $pgwTelephone
     */
    public function setPgwTelephone($pgwTelephone)
    {
        $this->pgwTelephone = $pgwTelephone;
    }

    /**
     * @return string
     */
    public function getPgwEmail()
    {
        return $this->pgwEmail;
    }

    /**
     * @param string $pgwEmail
     */
    public function setPgwEmail($pgwEmail)
    {
        $this->pgwEmail = $pgwEmail;
    }

    /**
     * @return string
     */
    public function getPgwmerchantData()
    {
        return $this->pgwmerchantData;
    }

    /**
     * @param string $pgwmerchantData
     */
    public function setPgwmerchantData($pgwmerchantData)
    {
        $this->pgwmerchantData = $pgwmerchantData;
    }

    /**
     * @return string
     */
    public function getPgwOrderInfo()
    {
        return $this->pgwOrderInfo;
    }

    /**
     * @param string $pgwOrderInfo
     */
    public function setPgwOrderInfo($pgwOrderInfo)
    {
        $this->pgwOrderInfo = $pgwOrderInfo;
    }

    /**
     * @return string
     */
    public function getPgwDisableInstallments()
    {
        return $this->pgwDisableInstallments;
    }

    /**
     * @param string $pgwDisableInstallments
     */
    public function setPgwDisableInstallments($pgwDisableInstallments)
    {
        $this->pgwDisableInstallments = $pgwDisableInstallments;
    }

    /**
     * @return string
     */
    public function getPgwSignature()
    {
        return SignatureGenerator::getSignature($this->secretKey, $this);
    }
}
