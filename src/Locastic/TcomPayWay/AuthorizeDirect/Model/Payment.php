<?php

namespace Locastic\TcomPayWay\AuthorizeDirect\Model;

use Locastic\TcomPayWay\AuthorizeDirect\Helpers\SignatureGenerator;
use Locastic\TcomPayWay\Helpers\MiscHelper;
use Locastic\TcomPayWay\Model\Payment as BasePayment;
use Locastic\TcomPayWay\Model\PaymentInterface;

/**
 * This model is used for preparing standard model of payment (athorize-form)
 *
 * Class Payment
 * @package Locastic\TcomPayWay\AuthorizeForm\Model
 */
class Payment extends BasePayment implements PaymentInterface
{
    /**
     * @var int
     */
    private $pgwInstallments;

    /**
     * @var string
     */
    private $pgwCardNumber;

    /**
     * @var string
     */
    private $pgwCardExpirationDate;

    /**
     * @var string
     */
    private $pgwCardVerificationData;


    /**
     * @param $pgwShopId
     * @param $secretKey
     * @param $pgwOrderId
     * @param $pgwAmount
     * @param $pgwAuthorizationType
     * @param $pgwSuccessUrl
     * @param $pgwFailureUrl
     * @param $pgwCardNumber
     * @param $pgwCardExpirationDate
     * @param $pgwCardVerificationData
     * @param $pgwFirstName
     * @param $pgwLastName
     * @param $pgwStreet
     * @param $pgwCity
     * @param $pgwPostCode
     * @param $pgwCountry
     * @param $pgwEmail
     */
    public function __construct(
        $pgwShopId,
        $secretKey,
        $pgwOrderId,
        $pgwAmount,
        $pgwAuthorizationType,
        $pgwSuccessUrl,
        $pgwFailureUrl,
        $pgwCardNumber,
        $pgwCardExpirationDate,
        $pgwCardVerificationData,
        $pgwFirstName,
        $pgwLastName,
        $pgwStreet,
        $pgwCity,
        $pgwPostCode,
        $pgwCountry,
        $pgwEmail
    ) {
        $this->pgwShopId = $pgwShopId;
        $this->secretKey = $secretKey;
        $this->pgwOrderId = $pgwOrderId;
        $this->pgwAmount = $pgwAmount;
        $this->pgwAuthorizationType = $pgwAuthorizationType;
        $this->pgwSuccessUrl = $pgwSuccessUrl;
        $this->pgwFailureUrl = $pgwFailureUrl;
        $this->pgwCardNumber = $pgwCardNumber;
        $this->pgwCardExpirationDate = $pgwCardExpirationDate;
        $this->pgwCardVerificationData = $pgwCardVerificationData;
        $this->setPgwFirstName($pgwFirstName);
        $this->setPgwLastName($pgwLastName);
        $this->setPgwStreet($pgwStreet);
        $this->setPgwPostCode($pgwPostCode);
        $this->setPgwCity($pgwCity);
        $this->setPgwCountry($pgwCountry);
        $this->setPgwEmail($pgwEmail);
    }

    /**
     * @return int
     */
    public function getPgwInstallments()
    {
        return $this->pgwInstallments;
    }

    /**
     * @param int $pgwInstallments
     */
    public function setPgwInstallments($pgwInstallments)
    {
        $this->pgwInstallments = $pgwInstallments;
    }

    /**
     * @return mixed
     */
    public function getPgwCardNumber()
    {
        return $this->pgwCardNumber;
    }

    /**
     * @param mixed $pgwCardNumber
     */
    public function setPgwCardNumber($pgwCardNumber)
    {
        $this->pgwCardNumber = $pgwCardNumber;
    }

    /**
     * @return mixed
     */
    public function getPgwCardExpirationDate()
    {
        return $this->pgwCardExpirationDate;
    }

    /**
     * @param mixed $pgwCardExpirationDate
     */
    public function setPgwCardExpirationDate($pgwCardExpirationDate)
    {
        $this->pgwCardExpirationDate = $pgwCardExpirationDate;
    }

    /**
     * @return mixed
     */
    public function getPgwCardVerificationData()
    {
        return $this->pgwCardVerificationData;
    }

    /**
     * @param mixed $pgwCardVerificationData
     */
    public function setPgwCardVerificationData($pgwCardVerificationData)
    {
        $this->pgwCardVerificationData = $pgwCardVerificationData;
    }

    /**
     * @return string
     */
    public function getPgwSignature()
    {
        return SignatureGenerator::getSignature($this->secretKey, $this);
    }

    public function setPgwFirstName($pgwFirstName)
    {
        $this->pgwFirstName = MiscHelper::clearUTF($pgwFirstName);
    }

    public function setPgwLastName($pgwLastName)
    {
        $this->pgwLastName = MiscHelper::clearUTF($pgwLastName);
    }

    public function setPgwStreet($pgwStreet)
    {
        $this->pgwStreet = MiscHelper::clearUTF($pgwStreet);
    }

    public function setPgwCity($pgwCity)
    {
        $this->pgwCity = MiscHelper::clearUTF($pgwCity);
    }

    public function setPgwPostCode($pgwPostCode)
    {
        $this->pgwPostCode = MiscHelper::clearUTF($pgwPostCode);
    }
}
