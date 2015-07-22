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
     * @param int $pgwShopId
     * @param string $secretKey
     * @param string $pgwOrderId
     * @param string $pgwAmount
     * @param string $pgwAuthorizationType
     * @param string $pgwSuccessUrl
     * @param string $pgwFailureUrl
     * @param string $pgwCardNumber
     * @param string $pgwCardExpirationDate
     * @param string $pgwCardVerificationData
     * @param string $pgwFirstName
     * @param string $pgwLastName
     * @param string $pgwStreet
     * @param string $pgwCity
     * @param string $pgwPostCode
     * @param string $pgwCountry
     * @param string $pgwEmail
     * @param bool|true $testMode
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
        $pgwEmail,
        $testMode = true
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
        $this->testMode = $testMode;
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
        return SignatureGenerator::generateSignature($this);
    }

    /**
     * @param string $pgwFirstName
     */
    public function setPgwFirstName($pgwFirstName)
    {
        $this->pgwFirstName = MiscHelper::clearUTF($pgwFirstName);
    }

    /**
     * @param string $pgwLastName
     */
    public function setPgwLastName($pgwLastName)
    {
        $this->pgwLastName = MiscHelper::clearUTF($pgwLastName);
    }

    /**
     * @param string $pgwStreet
     */
    public function setPgwStreet($pgwStreet)
    {
        $this->pgwStreet = MiscHelper::clearUTF($pgwStreet);
    }

    /**
     * @param string $pgwCity
     */
    public function setPgwCity($pgwCity)
    {
        $this->pgwCity = MiscHelper::clearUTF($pgwCity);
    }

    /**
     * @param string $pgwPostCode
     */
    public function setPgwPostCode($pgwPostCode)
    {
        $this->pgwPostCode = MiscHelper::clearUTF($pgwPostCode);
    }

    /**
     * @return string
     */
    public function getApiEndPoint()
    {
        if ($this->testMode) {
            return 'https://pgwtest.ht.hr/services/payment/api/authorize-direct';
        }

        return 'https://pgw.ht.hr/services/payment/api/authorize-direct';
    }

    /**
     * @param array $pgwResponse
     * @return bool
     */
    public function isPgwResponseValid($pgwResponse)
    {
        return $pgwResponse['pgw_signature'] == SignatureGenerator::generateSignatureFromArray(
            $this->secretKey,
            $pgwResponse
        );
    }
}
