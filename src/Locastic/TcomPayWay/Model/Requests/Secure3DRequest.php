<?php

namespace Locastic\TcomPayWay\Model\Requests;

use Locastic\TcomPayWay\Model\Card;
use Locastic\TcomPayWay\Model\Customer\CustomersClient;
use Locastic\TcomPayWay\Model\Payment;
use Locastic\TcomPayWay\Model\Shop;

class Secure3DRequest
{
    private $_shop;
    private $_card;
    private $_payment;
    private $_customersClient;

    function __construct(Shop $_shop, Payment $_payment, Card $_card, CustomersClient $customersClient)
    {
        $this->_shop = $_shop;
        $this->_payment = $_payment;
        $this->_card = $_card;
        $this->_customersClient = $customersClient;
    }

    public function getCard()
    {
        return $this->_card;
    }

    public function getCustomersClient()
    {
        return $this->_customersClient;
    }

    public function getPayment()
    {
        return $this->_payment;
    }

    public function getShop()
    {
        return $this->_shop;
    }
}