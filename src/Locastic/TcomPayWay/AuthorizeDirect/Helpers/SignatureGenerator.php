<?php

namespace Locastic\TcomPayWay\AuthorizeDirect\Helpers;

use Locastic\TcomPayWay\AuthorizeDirect\Model\Payment;

/**
 * Used for generating signature for payment request
 *
 * Class SignatureGenerator
 * @package Locastic\TcomPayWay\AuthorizeForm\Helpers
 */
class SignatureGenerator
{
    const METHOD_NAME = 'authorize-direct';

    /**
     * Based on payment model generates signature
     *
     * @param string $secretKey
     * @param Payment $payment
     *
     * @return string
     */
    public static function getSignature($secretKey, Payment $payment)
    {
        $string = self::METHOD_NAME.$secretKey;

        $string .= $payment->getPgwShopId().$secretKey;
        $string .= $payment->getPgwOrderId().$secretKey;
        $string .= $payment->getPgwAmount().$secretKey;
        $string .= $payment->getPgwInstallments().$secretKey;
        $string .= $payment->getPgwAuthorizationType().$secretKey;
        $string .= $payment->getPgwAuthorizationToken().$secretKey;
        $string .= $payment->getPgwLanguage().$secretKey;
        $string .= $payment->getPgwReturnMethod().$secretKey;
        $string .= $payment->getPgwSuccessUrl().$secretKey;
        $string .= $payment->getPgwFailureUrl().$secretKey;
        $string .= $payment->getPgwCardNumber().$secretKey;
        $string .= $payment->getPgwCardExpirationDate().$secretKey;
        $string .= $payment->getPgwCardVerificationData().$secretKey;
        $string .= $payment->getPgwFirstName().$secretKey;
        $string .= $payment->getPgwLastName().$secretKey;
        $string .= $payment->getPgwStreet().$secretKey;
        $string .= $payment->getPgwCity().$secretKey;
        $string .= $payment->getPgwPostCode().$secretKey;
        $string .= $payment->getPgwCountry().$secretKey;
        $string .= $payment->getPgwPhoneNumber().$secretKey;
        $string .= $payment->getPgwEmail().$secretKey;

        $string .= $payment->getPgwMerchantData().$secretKey;

        return hash('sha512', $string);
    }
}
