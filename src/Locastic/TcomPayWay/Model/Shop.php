<?php

namespace Locastic\TcomPayWay\Model;

class Shop
{
    private $_id;
    private $_username;
    private $_password;
    private $_secretKey;

    function __construct($id, $username, $password, $secretKey)
    {
        $this->_id = $id;
        $this->_username = $username;
        $this->_password = $password;
        $this->_secretKey = $secretKey;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getUsername()
    {
        return $this->_username;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function getSecretKey()
    {
        return $this->_secretKey;
    }

}
