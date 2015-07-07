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

    /**
     * @param string $secretKey
     * @param array  $pgwResponse
     * @return string
     */
    public static function generatePaymentResponseSuccessSignature($secretKey, $pgwResponse)
    {
        $string = '';

        $string .= $pgwResponse['pgw_trace_ref'].$secretKey;
        $string .= $pgwResponse['pgw_transaction_id'].$secretKey;
        $string .= $pgwResponse['pgw_order_id'].$secretKey;
        $string .= $pgwResponse['pgw_amount'].$secretKey;
        $string .= $pgwResponse['pgw_installments'].$secretKey;
        $string .= $pgwResponse['pgw_card_type_id'].$secretKey;
        $string .= $pgwResponse['pgw_merchant_data'].$secretKey;

        return hash('sha512', $string);
    }

    /**
     * @param string $secretKey
     * @param array  $pgwResponse
     * @return string
     */
    public static function generatePaymentResponseFailureSignature($secretKey, $pgwResponse)
    {
        $string = '';

        $string .= $pgwResponse['pgw_result_code'].$secretKey;
        $string .= $pgwResponse['pgw_trace_ref'].$secretKey;
        $string .= $pgwResponse['pgw_order_id'].$secretKey;
        $string .= $pgwResponse['pgw_merchant_data'].$secretKey;

        return hash('sha512', $string);
    }

    /**
     * @param Payment $payment
     * @param int     $announcementDuration
     * @return string
     */
    public static function generateAuthorizationAnnounceSignature(Payment $payment, $announcementDuration)
    {
        $secretKey = $payment->getSecretKey();

        $string = 'authorization-announce'.$secretKey;
        $string .= $payment->getPgwShopId().$secretKey;
        $string .= $payment->getPgwOrderId().$secretKey;
        $string .= $payment->getPgwAmount().$secretKey;
        $string .= $payment->getPgwAuthorizationType().$secretKey;
        $string .= $announcementDuration.$secretKey;

        return hash('sha512', $string);
    }

    /**
     * @param Payment $payment
     * @param int     $pgwTransactionId
     * @return string
     */
    public static function generateAuthorizationCompleteSignature(Payment $payment, $pgwTransactionId)
    {
        $secretKey = $payment->getSecretKey();

        $string = 'authorization-complete'.$secretKey;
        $string .= $payment->getPgwShopId().$secretKey;
        $string .= $pgwTransactionId.$secretKey;
        $string .= $payment->getPgwAmount().$secretKey;

        return hash('sha512', $string);
    }

    /**
     * @param Payment $payment
     * @param int     $pgwTransactionId
     * @return string
     */
    public static function generateAuthorizationCancelSignature(Payment $payment, $pgwTransactionId)
    {
        $secretKey = $payment->getSecretKey();

        $string = 'authorization-cancel'.$secretKey;
        $string .= $payment->getPgwShopId().$secretKey;
        $string .= $pgwTransactionId.$secretKey;

        return hash('sha512', $string);
    }

    /**
     * @param Payment $payment
     * @param int     $pgwTransactionId
     * @return string
     */
    public static function generateAuthorizationRefundSignature(Payment $payment, $pgwTransactionId)
    {
        $secretKey = $payment->getSecretKey();

        $string = 'authorization-refund'.$secretKey;
        $string .= $payment->getPgwShopId().$secretKey;
        $string .= $pgwTransactionId.$secretKey;
        $string .= $payment->getPgwAmount().$secretKey;

        return hash('sha512', $string);
    }

    /**
     * @param Payment $payment
     * @param int     $pgwTransactionId
     * @return string
     */
    public static function generateAuthorizationInfoSignature(Payment $payment, $pgwTransactionId)
    {
        $secretKey = $payment->getSecretKey();

        $string = 'authorization-info'.$secretKey;
        $string .= $payment->getPgwShopId().$secretKey;
        $string .= $pgwTransactionId.$secretKey;
        $string .= $payment->getPgwOrderId().$secretKey;

        return hash('sha512', $string);
    }
}
