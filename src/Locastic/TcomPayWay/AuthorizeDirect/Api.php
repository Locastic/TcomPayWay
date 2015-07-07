<?php

namespace Locastic\TcomPayWay\AuthorizeDirect;

use Buzz\Browser;
use Locastic\TcomPayWay\AuthorizeDirect\Helpers\SignatureGenerator;
use Locastic\TcomPayWay\AuthorizeDirect\Model\Payment;

class Api
{
    /**
     * @var Payment
     */
    private $payment;

    /**
     * @var string
     */
    private $apiLocation;

    /**
     * @var Browser
     */
    private $browser;

    /**
     * @var array
     */
    private $headers;

    /**
     * @param Payment $payment
     * @param boolean $testMode
     */
    public function __construct(Payment $payment, $testMode = true)
    {
        $this->payment = $payment;
        $this->browser = new Browser();

        if ($testMode) {
            $this->apiLocation = 'https://pgwtest.ht.hr/services/payment/api/';
        } else {
            $this->apiLocation = 'https://pgw.ht.hr/services/payment/api/';
        }

        $this->headers = array(
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Basic',
        );
    }

    /**
     * @param int $announcementDuration
     *
     * @return array
     */
    public function authorizationAnnounce($announcementDuration)
    {
        $result = $this->browser->post(
            $this->apiLocation.'authorization-announce',
            $this->headers,
            $this->getAuthorizationAnnounceRequestContent($announcementDuration)
        );

        return json_decode($result->getContent());
    }

    /**
     * @param string $pgwTransactionId
     *
     * @return array
     */
    public function authorizationComplete($pgwTransactionId)
    {
        $result = $this->browser->post(
            $this->apiLocation.'authorization-complete',
            $this->headers,
            $this->getAuthorizationCompleteRequestContent($pgwTransactionId)
        );

        return json_decode($result->getContent());
    }

    /**
     * @param string $pgwTransactionId
     *
     * @return array
     */
    public function authorizationCancel($pgwTransactionId)
    {
        $result = $this->browser->post(
            $this->apiLocation.'authorization-cancel',
            $this->headers,
            $this->getAuthorizationCancelRequestContent($pgwTransactionId)
        );

        return json_decode($result->getContent());
    }

    /**
     * @param string $pgwTransactionId
     *
     * @return array
     */
    public function authorizationRefund($pgwTransactionId)
    {
        $result = $this->browser->post(
            $this->apiLocation.'authorization-refund',
            $this->headers,
            $this->getAuthorizationRefundRequestContent($pgwTransactionId)
        );

        return json_decode($result->getContent());
    }

    /**
     * @param string $pgwTransactionId
     *
     * @return array
     */
    public function authorizationInfo($pgwTransactionId)
    {
        $result = $this->browser->post(
            $this->apiLocation.'authorization-info',
            $this->headers,
            $this->getAuthorizationInfoRequestContent($pgwTransactionId)
        );

        return json_decode($result->getContent());
    }

    /**
     * @param string $cardNumber
     *
     * @return array
     */
    public function installments($cardNumber)
    {
        $result = $this->browser->post(
            $this->apiLocation.'installments',
            $this->headers,
            $this->getInstallmentsRequestContent($cardNumber)
        );

        return json_decode($result->getContent());
    }

    /**
     * @param int $announcementDuration
     * @return string
     */
    private function getAuthorizationAnnounceRequestContent($announcementDuration)
    {
        $request = array(
            'pgw_shop_id' => $this->payment->getPgwShopId(),
            'pgw_order_id' => $this->payment->getPgwOrderId(),
            'pgw_amount' => $this->payment->getPgwAmount(),
            'pgw_authorization_type' => $this->payment->getPgwAuthorizationType(),
            'pgw_announcement_duration' => $announcementDuration,
            'pgw_signature' => SignatureGenerator::generateAuthorizationAnnounceSignature(
                $this->payment,
                $announcementDuration
            ),
        );

        return json_encode($request);
    }

    /**
     * @param int $pgwTransactionId
     *
     * @return string
     */
    private function getAuthorizationCompleteRequestContent($pgwTransactionId)
    {
        $request = array(
            'pgw_shop_id' => $this->payment->getPgwShopId(),
            'pgw_transaction_id' => $pgwTransactionId,
            'pgw_amount' => $this->payment->getPgwAmount(),
            'pgw_signature' => SignatureGenerator::generateAuthorizationCompleteSignature(
                $this->payment,
                $pgwTransactionId
            ),
        );

        return json_encode($request);
    }

    /**
     * @param int $pgwTransactionId
     *
     * @return string
     */
    private function getAuthorizationCancelRequestContent($pgwTransactionId)
    {
        $request = array(
            'pgw_shop_id' => $this->payment->getPgwShopId(),
            'pgw_transaction_id' => $pgwTransactionId,
            'pgw_signature' => SignatureGenerator::generateAuthorizationCancelSignature(
                $this->payment,
                $pgwTransactionId
            ),
        );

        return json_encode($request);
    }

    /**
     * @param int $pgwTransactionId
     *
     * @return string
     */
    private function getAuthorizationRefundRequestContent($pgwTransactionId)
    {
        $request = array(
            'pgw_shop_id' => $this->payment->getPgwShopId(),
            'pgw_transaction_id' => $pgwTransactionId,
            'pgw_amount' => $this->payment->getPgwAmount(),
            'pgw_signature' => SignatureGenerator::generateAuthorizationCancelSignature(
                $this->payment,
                $pgwTransactionId
            ),
        );

        return json_encode($request);
    }

    /**
     * @param int $pgwTransactionId
     *
     * @return string
     */
    private function getAuthorizationInfoRequestContent($pgwTransactionId)
    {
        $request = array(
            'pgw_shop_id' => $this->payment->getPgwShopId(),
            'pgw_transaction_id' => $pgwTransactionId,
            'pgw_order_id' => $this->payment->getPgwOrderId(),
            'pgw_signature' => SignatureGenerator::generateAuthorizationInfoSignature(
                $this->payment,
                $pgwTransactionId
            ),
        );

        return json_encode($request);
    }

    /**
     * @param string $cardNumber
     *
     * @return string
     */
    private function getInstallmentsRequestContent($cardNumber)
    {
        $request = array(
            'pgw_shop_id' => $this->payment->getPgwShopId(),
            'pgw_amount' => $this->payment->getPgwAmount(),
            'pgw_card_number' => $cardNumber,
            'pgw_signature' => SignatureGenerator::generateAuthorizationInfoSignature(
                $this->payment,
                $cardNumber
            ),
        );

        return json_encode($request);
    }
}
