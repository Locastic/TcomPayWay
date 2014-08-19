<?php

namespace Locastic\TcomPayWay\Model\Customer;

class CustomersClient
{
    private $_httpAccept;
    private $_httpUserAgent;
    private $_originIP;

    function __construct($httpAccept, $httpUserAgent, $originIP)
    {
        $this->_httpAccept = $httpAccept;
        $this->_httpUserAgent = $httpUserAgent;
        $this->_originIP = $originIP;
    }

    public function getHttpAccept()
    {
        return $this->_httpAccept;
    }

    public function getHttpUserAgent()
    {
        return $this->_httpUserAgent;
    }

    public function getOriginIP()
    {
        return $this->_originIP;
    }

}