<?php

namespace Locastic\TcomPayWay\AuthorizeForm\Helpers;

use Locastic\TcomPayWay\AuthorizeForm\Model\Payment;

/**
 * Used for generating signature for payment request
 *
 * Class SignatureGenerator
 * @package Locastic\TcomPayWay\AuthorizeForm\Helpers
 */
class SignatureGenerator
{
    const METHOD_NAME = 'authorize-form';

    /**
     * Based on payment model generates signature
     *
     * @param string  $secretKey
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
        $string .= $payment->getPgwAuthorizationType().$secretKey;

        if ($payment->getPgwAuthorizationToken() != '') {
            $string .= $payment->getPgwAuthorizationToken().$secretKey;
        }

        $string .= $payment->getPgwLanguage().$secretKey;

        if ($payment->getPgwReturnMethod() != '') {
            $string .= $payment->getPgwReturnMethod().$secretKey;
        }

        $string .= $payment->getPgwSuccessUrl().$secretKey;
        $string .= $payment->getPgwFailureUrl().$secretKey;

        if ($payment->getPgwFirstName() != '') {
            $string .= $payment->getPgwFirstName().$secretKey;
        }

        if ($payment->getPgwLastName() != '') {
            $string .= $payment->getPgwLastName().$secretKey;
        }

        if ($payment->getPgwStreet() != '') {
            $string .= $payment->getPgwStreet().$secretKey;
        }

        if ($payment->getPgwCity() != '') {
            $string .= $payment->getPgwCity().$secretKey;
        }

        if ($payment->getPgwPostCode() != '') {
            $string .= $payment->getPgwPostCode().$secretKey;
        }

        if ($payment->getPgwCountry() != '') {
            $string .= $payment->getPgwCountry().$secretKey;
        }

        if ($payment->getPgwPhoneNumber() != '') {
            $string .= $payment->getPgwPhoneNumber().$secretKey;
        }

        if ($payment->getPgwEmail() != '') {
            $string .= $payment->getPgwEmail().$secretKey;
        }

        if ($payment->getPgwmerchantData() != '') {
            $string .= $payment->getPgwmerchantData().$secretKey;
        }

        if ($payment->getPgwOrderInfo() != '') {
            $string .= $payment->getPgwOrderInfo().$secretKey;
        }

        if ($payment->getPgwOrderItems() != '') {
            $string .= $payment->getPgwOrderItems().$secretKey;
        }

        if ($payment->getPgwDisableInstallments() != '') {
            $string .= $payment->getPgwDisableInstallments().$secretKey;
        }

        return hash('sha512', $string);
    }
}
