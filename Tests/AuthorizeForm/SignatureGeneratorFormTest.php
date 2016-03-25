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
        $payment = new Payment(
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
            SignatureGenerator::generateSignature($payment)
        );

        $payment = new Payment(
            123,
            'new-secret-key',
            'narudžba456',
            789,
            1,
            'http://www.mojducan.com/success/narudžba456',
            'http://www.mojducan.com/failure/narudžba456'
        );

        $payment->setPgwFirstName('John');
        $payment->setPgwLastName('Smith');
        $payment->setPgwStreet('Some Street 49');
        $payment->setPgwCity('Split');
        $payment->setPgwEmail('email@example.com');
        $payment->setPgwDisableInstallments(1);
        $payment->setPgwAuthorizationType(1);
        $payment->setPgwAuthorizationToken('SomeTOken123');

        $this->assertEquals(
            'eaa9e7587db7751fc6b7cd97f9d5ea735dece3c115fc344ebf85d8d65c462764ec1cf220c55e8b69313f787eb8f2a13e522558b747e3842617eb70ca2dd128cc',
            SignatureGenerator::generateSignature($payment)
        );
    }

    public function testGetOrderedResponseSignature()
    {
        
        $response = [
            'pgw_amount' => '6789',
            'pgw_card_type_id' => '3',
            'pgw_installments' => '0',
            'pgw_merchant_data' => '',
            'pgw_order_id' => 'test1',
            'pgw_trace_ref' => '123456789',
            'pgw_transaction_id' => '12455',
        ];
        
        $this->assertEquals(
            '1c98b942b75b0fe931c6240af81f1c2105f8285d0a7284d85f9d740fe5801089e7ab66cd572e8e871c4a803bf89cb3a9ffebd52b27521da58b851b87ca2e7742',
            SignatureGenerator::generateOrderedSignatureFromArray('12345', $response)
        );
    }
}
