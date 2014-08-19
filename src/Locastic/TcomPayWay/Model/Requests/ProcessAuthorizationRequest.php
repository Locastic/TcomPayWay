<?php

namespace Locastic\TcomPayWay\Model\Requests;

use Locastic\TcomPayWay\Model\Transaction;

class ProcessAuthorizationRequest
{
    private $_shop;
    private $_card;
    private $_payment;
    private $_customersClient;

    function __construct(Transaction $transaction)
    {
        $this->_shop = $transaction->getShop();
        $this->_payment = $transaction->getPayment();
        $this->_card = $transaction->getCard();
        $this->_customersClient = $transaction->getCustomer()->getClient();
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