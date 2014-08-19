<?php

namespace Locastic\TcomPayWay\Clients;

interface SoapClientInterface
{
    public function initClient($wsdlUrl, $options);
}