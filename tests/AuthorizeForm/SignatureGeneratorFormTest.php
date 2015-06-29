<?php

use Locastic\TcomPayWay\AuthorizeForm\Model\Payment;
use Locastic\TcomPayWay\AuthorizeForm\Helpers\SignatureGenerator;

class SignatureGeneratorFormTest extends PHPUnit_Framework_TestCase
{
    /**
     * Testing password generator
     */
    public function testGetSignature()
    {
        $model = new Payment(
            123,
            'secretkey',
            'narudžba456',
            789,
            0,
            'http://www.mojducan.com/success/narudžba456',
            'http://www.mojducan.com/failure/narudžba456'
        );

        $this->assertEquals(
            '8295bfece351e248e73870ad10ffb9dc63abd807582e5fdd4348d12284f6b8cc13e93eaa502034c1cb4114ddc84f19868d4ebfff55682e0c521a96a5022974cb',
            SignatureGenerator::getSignature('secretkey', $model)
        );
    }
}
