<?php

namespace Locastic\TcomPayWay\AuthorizeDirect;

use Buzz\Browser;
use Buzz\Client\Curl;
use Buzz\Listener\BasicAuthListener;
use Locastic\TcomPayWay\AuthorizeDirect\Helpers\SignatureGenerator;

/**
 * Class Api
 * @package Locastic\TcomPayWay\AuthorizeDirect
 */
class Api
{
    /**
     * @var string
     */
    private $apiLocation;

    /**
     * @var string
     */
    protected $shopId;

    /**
     * @var string
     */
    protected $secretKey;

    /**
     * @var int
     */
    protected $authorizationType;

    /**
     * @var bool|true
     */
    protected $sandbox;

    /**
     * @var array
     */
    protected $headers;

    /**
     * @param string    $username
     * @param string    $password
     * @param int       $shopId
     * @param string    $secretKey
     * @param int       $authorizationType
     * @param bool|true $sandbox
     */
    public function __construct($username, $password, $shopId, $secretKey, $authorizationType = 0, $sandbox = true)
    {
        if (false == is_string($username) or false == is_string($password)) {
            throw new \LogicException('The username and password must be strings.');
        }

        if (false == is_int($shopId)) {
            throw new \LogicException('The integer Shop ID option must be set.');
        }

        if (false == is_string($secretKey)) {
            throw new \LogicException('The string secret key option must be set.');
        }

        if (false == is_bool($sandbox)) {
            throw new \LogicException('The boolean sandbox option must be set.');
        }

        $this->shopId = $shopId;
        $this->secretKey = $secretKey;
        $this->authorizationType = $authorizationType;
        $this->sandbox = $sandbox;
        $this->apiLocation = $this->getApiEndpoint();

        $this->browser = new Browser(new Curl());
        $this->browser->addListener(new BasicAuthListener($username, $password));

        $this->headers = array(
            'Content-Type' => 'application/x-www-form-urlencoded',
        );
    }

    /**
     * @param string $pgwOrderId
     * @param int    $pgwAmount
     * @param int    $pgwAnnouncementDuration
     * @return array
     */
    public function authorizationAnnounce($pgwOrderId, $pgwAmount, $pgwAnnouncementDuration = 60)
    {
        $data = array(
            'method' => 'authorization-announce',
            'pgw_shop_id' => $this->shopId,
            'pgw_order_id' => $pgwOrderId,
            'pgw_amount' => $pgwAmount,
            'pgw_authorization_type' => $this->authorizationType,
            'pgw_announcement_duration' => $pgwAnnouncementDuration,
        );

        $data['pgw_signature'] = SignatureGenerator::generateSignatureFromArray($this->secretKey, $data);

        return $this->doRequest($data);
    }

    /**
     * @param string $pgwTransactionId
     * @param int    $pgwAmount
     * @return array
     */
    public function authorizationComplete($pgwTransactionId, $pgwAmount)
    {
        $data = array(
            'method' => 'authorization-complete',
            'pgw_shop_id' => $this->shopId,
            'pgw_transaction_id' => $pgwTransactionId,
            'pgw_amount' => $pgwAmount,
        );

        $data['pgw_signature'] = SignatureGenerator::generateSignatureFromArray($this->secretKey, $data);

        return $this->doRequest($data);
    }

    /**
     * @param string $pgwTransactionId
     * @return array
     */
    public function authorizationCancel($pgwTransactionId)
    {
        $data = array(
            'method' => 'authorization-cancel',
            'pgw_shop_id' => $this->shopId,
            'pgw_transaction_id' => $pgwTransactionId,
        );

        $data['pgw_signature'] = SignatureGenerator::generateSignatureFromArray($this->secretKey, $data);

        return $this->doRequest($data);
    }

    /**
     * @param string $pgwTransactionId
     * @param int    $pgwAmount
     * @return array
     */
    public function authorizationRefund($pgwTransactionId, $pgwAmount)
    {
        $data = array(
            'method' => 'authorization-refund',
            'pgw_shop_id' => $this->shopId,
            'pgw_amount' => $pgwAmount,
            'pgw_transaction_id' => $pgwTransactionId,
        );

        $data['pgw_signature'] = SignatureGenerator::generateSignatureFromArray($this->secretKey, $data);

        return $this->doRequest($data);
    }

    /**
     * @param string $pgwTransactionId
     * @param string $pgwOrderId
     * @return array
     */
    public function authorizationInfo($pgwTransactionId, $pgwOrderId)
    {
        $data = array(
            'method' => 'authorization-info',
            'pgw_shop_id' => $this->shopId,
            'pgw_transaction_id' => $pgwTransactionId,
            'pgw_order_id' => $pgwOrderId,
        );

        $data['pgw_signature'] = SignatureGenerator::generateSignatureFromArray($this->secretKey, $data);

        return $this->doRequest($data);
    }

    /**
     * @param int    $pgwAmount
     * @param string $pgwCardNumber
     * @return array
     */
    public function installments($pgwAmount, $pgwCardNumber)
    {
        $data = array(
            'method' => 'installments',
            'pgw_shop_id' => $this->shopId,
            'pgw_amount' => $pgwAmount,
            'pgw_card_number' => $pgwCardNumber,
        );

        $data['pgw_signature'] = SignatureGenerator::generateSignatureFromArray($this->secretKey, $data);

        return $this->doRequest($data);
    }

    /**
     * @param array $data
     * @return array
     */
    private function doRequest($data)
    {
        $result = $this->browser->post(
            $this->apiLocation.$data['method'],
            $this->headers,
            $data
        );

        return json_decode($result->getContent());
    }

    /**
     * @return string
     */
    private function getApiEndpoint()
    {
        if ($this->sandbox) {
            return 'https://pgwtest.ht.hr/services/payment/api/';
        }

        return 'https://pgw.ht.hr/services/payment/api/';
    }
}
