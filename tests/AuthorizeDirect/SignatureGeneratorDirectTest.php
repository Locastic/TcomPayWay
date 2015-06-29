<?php

use Locastic\TcomPayWay\AuthorizeDirect\Model\Payment;
use Locastic\TcomPayWay\AuthorizeDirect\Helpers\SignatureGenerator;

class SignatureGeneratorDirectTest extends PHPUnit_Framework_TestCase
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
            'http://www.mojducan.com/failure/narudžba456',
            '111111111111111',
            '1812',
            '123',
            'Test',
            'Testic',
            'Testna bb',
            'Testograd',
            12345,
            'Testozemska',
            'email@email.com'
        );

        $model->setPgwPhoneNumber('012345678');

        $this->assertEquals(
            '67837faa88d323ab6cd61502bd930adc524a5da8e3849cde2b5bc18561306f50d4cb862e4a26ea1aa019d60ceced2da503d2c5fcd7391ea20d4a16158cde51d4',
            SignatureGenerator::getSignature('secretkey', $model)
        );
    }
}
