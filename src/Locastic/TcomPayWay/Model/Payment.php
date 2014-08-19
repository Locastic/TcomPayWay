<?php

namespace Locastic\TcomPayWay\Model;

class Payment
{
    private $_amount;
    private $_mode;
    private $_numOfInstallments;
    private $_shoppingCartId;

    function __construct($shoppingCartId, $amount, $numOfInstallments, $mode)
    {
        $this->_shoppingCartId = $shoppingCartId;
        $this->_amount = $amount;
        $this->_mode = $mode;
        $this->_numOfInstallments = $numOfInstallments;
    }

    public function getAmount()
    {
        return $this->_amount;
    }

    public function getNumOfInstallments()
    {
        return $this->_numOfInstallments;
    }

    public function getMode()
    {
        return $this->_mode;
    }

    public function getShoppingCartId()
    {
        return $this->_shoppingCartId;
    }

}