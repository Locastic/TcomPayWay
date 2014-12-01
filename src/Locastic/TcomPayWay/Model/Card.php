<?php

namespace Locastic\TcomPayWay\Model;

use Locastic\TcomPayWay\Helpers\CardHelper;

class Card
{
    /**
     * @var string
     */
    private $_id;

    /**
     * @var string
     */
    private $_number;

    /**
     * @var \DateTime
     */
    private $_expDate;

    /**
     * @var string
     */
    private $_cvd;

    function __construct($number, $expDate, $cvd)
    {
        $this->_id = null;
        $this->_number = $number;
        $this->_expDate = new \DateTime($expDate);
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
        return $this->_expDate->format('ym');
    }

    public function getCvd()
    {
        return $this->_cvd;
    }
}
