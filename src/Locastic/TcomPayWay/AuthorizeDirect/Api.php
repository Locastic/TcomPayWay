<?php

namespace Locastic\TcomPayWay\AuthorizeDirect;

use Buzz\Browser;
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
     * @param Payment $payment
     * @param string $apiLocation
     */
    function __construct(Payment $payment, $apiLocation = 'https://pgw.ht.hr/services/payment/api/')
    {
        $this->payment = $payment;
        $this->browser = new Browser();
        $this->apiLocation = $apiLocation;
    }

    public function authorizationAnnounce($anounceDuration)
    {
        $this->browser->post($this->apiLocation.'authorization-announce');
    }

    private function getAuthorizationAnounceRequest(Payment $payment, $anounceDuration)
    {
        $request = array(
            'pgw_shop_id' => ,
            'pgw_order_id' => ,
            'pgw_amount' => ,
            'pgw_authorization_type' => ,
            'pgw_announcment_duration' => ,
            'pgw_signature' => ,
        );
    }
}