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
            12345,
            'secretkey',
            'order-123',
            102400,
            0,
            'http://www.mojducan.com/success/order-123',
            'http://www.mojducan.com/failure/order-123',
            '111111111111111',
            '1812',
            '123',
            'John',
            'Smith',
            'Street 49',
            'Locastic City',
            '1950',
            'LocasticLand',
            'email@example.com'
        );

        $this->assertEquals(
            'f0a8e275979fe2da37c80d6dd668f47aa0510539134dd9a68eb8e75ffa841c0523489f8ddffd25baa9b6105c95aad098aab08e84cbfc4fca47fafab210bffd54',
            SignatureGenerator::getSignature('secretkey', $model)
        );

        $model = new Payment(
            123456789,
            'new-secret-key',
            'order-no-135',
            195000,
            1,
            'http://www.mojducan.com/success/order-no-135',
            'http://www.mojducan.com/failure/order-no-135',
            '111111111111111',
            '1812',
            '123',
            'John',
            'Smith',
            'Street 49',
            'Locastic City',
            '1911',
            'LocasticLand',
            'email@example.com'
        );

        $model->setPgwReturnMethod('get');
        $model->setPgwInstallments('12');
        $model->setPgwPhoneNumber('098123456789');
        $model->setPgwMerchantData('item1|item2|item3');

        $this->assertEquals(
            '7ab8d368e0b1143f05f56d0f5f65d3dbbd101f9cd824587934225d141fa7806746afd5258679665d1fd876ff33f1c0273a7c81fab9340b4535cdc9dc7ca713a6',
            SignatureGenerator::getSignature('new-secret-key', $model)
        );
    }

    /**
     * Testing signature generator for success payment request
     */
    public function testPgwSuccessResponseSignatureGenerator()
    {
        $reponse = array(
            'pgw_trace_ref' => '20000445-7572eef90f922e2529c2f813ba4edeaa-20150707112327024',
            'pgw_transaction_id' => '6055',
            'pgw_order_id' => '559b9a4c78d29',
            'pgw_amount' => 123,
            'pgw_installments' => 3,
            'pgw_card_type_id' => 3,
            'pgw_merchant_data' => '',
            'pgw_signature' => '5f61773a2dca6d4a57797efc0171116ed608e7c5c78e9880bea5d9e8459efa2acf30360866b303c37b8ce63770a04a88ebfbd8b05a6814247667d75940e64a66',
        );

        $this->assertEquals(
            '5f61773a2dca6d4a57797efc0171116ed608e7c5c78e9880bea5d9e8459efa2acf30360866b303c37b8ce63770a04a88ebfbd8b05a6814247667d75940e64a66',
            SignatureGenerator::generatePaymentResponseSuccessSignature('new-secret-key', $reponse)
        );
    }

    /**
     * Testing signature generator for failed payment request
     */
    public function testPgwFailureResponseSignatureGenerator()
    {
        $reponse = array(
            'pgw_result_code' => '1004',
            'pgw_trace_ref' => '20000445-7572eef90f922e2529c2f813ba4edeaa-20150707112327024',
            'pgw_order_id' => '559b9a4c78d29',
            'pgw_merchant_data' => '',
            'pgw_signature' => '5f61773a2dca6d4a57797efc0171116ed608e7c5c78e9880bea5d9e8459efa2acf30360866b303c37b8ce63770a04a88ebfbd8b05a6814247667d75940e64a66',
        );

        $this->assertEquals(
            '8b42902e9e09218f032336d3ca041df8a650e0705cfee50798123a48203194e670ceb0247e45f106e9fb8324e9e501bbe749ccbe5aafebd903c2b85a50bb2d46',
            SignatureGenerator::generatePaymentResponseFailureSignature('new-secret-key', $reponse)
        );
    }
}
