<?php

namespace Locastic\TcomPayWay\AuthorizeForm\Model;

use Locastic\TcomPayWay\AuthorizeForm\Helpers\SignatureGenerator;
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
     * @var boolean (1 or 0)
     */
    private $pgwDisableInstallments;

    /**
     * @param string  $pgwShopId
     * @param string  $secretKey
     * @param string  $pgwOrderId
     * @param string  $pgwAmount
     * @param string  $pgwAuthorizationType
     * @param string  $pgwSuccessUrl
     * @param string  $pgwFailureUrl
     * @param boolean $sandbox
     */
    public function __construct(
        $pgwShopId,
        $secretKey,
        $pgwOrderId,
        $pgwAmount,
        $pgwAuthorizationType,
        $pgwSuccessUrl,
        $pgwFailureUrl,
        $sandbox = true
    ) {
        $this->pgwShopId = $pgwShopId;
        $this->secretKey = $secretKey;
        $this->pgwOrderId = $pgwOrderId;
        $this->pgwAmount = $pgwAmount;
        $this->pgwAuthorizationType = $pgwAuthorizationType;
        $this->pgwSuccessUrl = $pgwSuccessUrl;
        $this->pgwFailureUrl = $pgwFailureUrl;
        $this->sandbox = $sandbox;
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
        return SignatureGenerator::generateSignature($this);
    }

    /**
     * @return string
     */
    public function getApiEndPoint()
    {
        if ($this->sandbox) {
            return 'https://pgwtest.ht.hr/services/payment/api/authorize-form';
        }

        return 'https://pgw.ht.hr/services/payment/api/authorize-form';
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

    /**
     * @param array $pgwResponse
     * @return bool
     */
    public function isPgwOrderedResponseValid($pgwResponse)
    {
        return $pgwResponse['pgw_signature'] == SignatureGenerator::generateOrderedSignatureFromArray(
            $this->secretKey,
            $pgwResponse
        );
    }
}
