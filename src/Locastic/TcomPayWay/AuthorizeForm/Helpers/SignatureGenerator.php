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
     * @param Payment $payment
     *
     * @return string
     */
    public static function generateSignature(Payment $payment)
    {
        $secretKey = $payment->getSecretKey();
        $string = self::METHOD_NAME.$secretKey;

        $string .= $payment->getPgwShopId().$secretKey;
        $string .= $payment->getPgwOrderId().$secretKey;
        $string .= $payment->getPgwAmount().$secretKey;
        $string .= $payment->getPgwAuthorizationType().$secretKey;
        $string .= $payment->getPgwAuthorizationToken().$secretKey;
        $string .= $payment->getPgwLanguage().$secretKey;
        $string .= $payment->getPgwReturnMethod().$secretKey;
        $string .= $payment->getPgwSuccessUrl().$secretKey;
        $string .= $payment->getPgwFailureUrl().$secretKey;
        $string .= $payment->getPgwFirstName().$secretKey;
        $string .= $payment->getPgwLastName().$secretKey;
        $string .= $payment->getPgwStreet().$secretKey;
        $string .= $payment->getPgwCity().$secretKey;
        $string .= $payment->getPgwPostCode().$secretKey;
        $string .= $payment->getPgwCountry().$secretKey;
        $string .= $payment->getPgwPhoneNumber().$secretKey;
        $string .= $payment->getPgwEmail().$secretKey;
        $string .= $payment->getPgwmerchantData().$secretKey;
        $string .= $payment->getPgwOrderInfo().$secretKey;
        $string .= $payment->getPgwOrderItems().$secretKey;
        $string .= $payment->getPgwDisableInstallments().$secretKey;

        return hash('sha512', $string);
    }

    /**
     * @param string $secretKey
     * @param array  $data
     * @return string
     */
    public static function generateSignatureFromArray($secretKey, $data)
    {
        $string = '';

        foreach ($data as $key => $value) {
            if ('pgw_signature' == $key) {
                continue;
            }

            $string .= $value.$secretKey;
        }

        return hash('sha512', $string);
    }

    /**
     * @param string $secretKey
     * @param array  $data
     * @return string
     */
    public static function generateOrderedSignatureFromArray($secretKey, $data)
    {
        $string = $data['pgw_trace_ref'].$secretKey;
        $string .= $data['pgw_transaction_id'].$secretKey;
        $string .= $data['pgw_order_id'].$secretKey;
        $string .= $data['pgw_amount'].$secretKey;
        $string .= $data['pgw_installments'].$secretKey;
        $string .= $data['pgw_card_type_id'].$secretKey;
        $string .= $data['pgw_merchant_data'].$secretKey;

        return hash('sha512', $string);
    }
}
