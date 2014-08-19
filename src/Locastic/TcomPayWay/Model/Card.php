<?php

namespace Locastic\TcomPayWay\Model;

use Locastic\TcomPayWay\Helpers\CardHelper;

class Card
{
    private $_id;
    private $_number;
    private $_expMonth;
    private $_expYear;
    private $_expDate;
    private $_cvd;

    function __construct($number, $expMonth, $expYear, $cvd)
    {
        $this->_id = null;
        $this->_number = $number;
        $this->_expMonth = $expMonth;
        $this->_expYear = $expYear;
        $this->_expDate = null;
        $this->_cvd = $cvd;
    }

    public function getId()
    {
        return CardHelper::getCardId($this->_number);
    }

    public function getNumber()
    {
        return $this->_number;
    }

    public function getExpDate()
    {
        return CardHelper::getExpDate($this->_expYear, $this->_expMonth);
    }

    public function getCvd()
    {
        return $this->_cvd;
    }

}