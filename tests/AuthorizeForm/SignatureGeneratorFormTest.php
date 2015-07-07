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
            '178b4e0f865f0576857b54cbdcb1b88871792ba976e1ca707f2eb10f4e7cef00e9e6526a2f72bb2584f66c73c6805f062ce8da56d6a3cfe9edfa32ec75bf615a',
            SignatureGenerator::getSignature('secretkey', $model)
        );

        $model = new Payment(
            123,
            'new-secret-key',
            'narudžba456',
            789,
            1,
            'http://www.mojducan.com/success/narudžba456',
            'http://www.mojducan.com/failure/narudžba456'
        );

        $model->setPgwFirstName('John');
        $model->setPgwLastName('Smith');
        $model->setPgwStreet('Some Street 49');
        $model->setPgwCity('Split');
        $model->setPgwEmail('email@example.com');
        $model->setPgwDisableInstallments(1);
        $model->setPgwAuthorizationType(1);
        $model->setPgwAuthorizationToken('SomeTOken123');

        $this->assertEquals(
            'eaa9e7587db7751fc6b7cd97f9d5ea735dece3c115fc344ebf85d8d65c462764ec1cf220c55e8b69313f787eb8f2a13e522558b747e3842617eb70ca2dd128cc',
            SignatureGenerator::getSignature('new-secret-key', $model)
        );
    }
}
