<?php

use Locastic\TcomPayWay\AuthorizeDirect\Model\Payment;
use Locastic\TcomPayWay\AuthorizeDirect\Helpers\SignatureGenerator;

class SignatureGeneratorDirectTest extends PHPUnit_Framework_TestCase
{
    /**
     * Testing password generator
     */
    public function testGenerateSignature()
    {
        $payment = new Payment(
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
            SignatureGenerator::generateSignature($payment)
        );

        $payment = new Payment(
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

        $payment->setPgwReturnMethod('get');
        $payment->setPgwInstallments('12');
        $payment->setPgwPhoneNumber('098123456789');
        $payment->setPgwMerchantData('item1|item2|item3');

        $this->assertEquals(
            '7ab8d368e0b1143f05f56d0f5f65d3dbbd101f9cd824587934225d141fa7806746afd5258679665d1fd876ff33f1c0273a7c81fab9340b4535cdc9dc7ca713a6',
            SignatureGenerator::generateSignature($payment)
        );
    }

    /**
     * Testing signature generator for success payment request
     */
    public function testPgwSuccessResponseSignatureGenerator()
    {
        $response = array(
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
            SignatureGenerator::generateSignatureFromArray('new-secret-key', $response)
        );
    }

    /**
     * Testing signature generator for failed payment request
     */
    public function testPgwFailureResponseSignatureGenerator()
    {
        $response = array(
            'pgw_result_code' => '1004',
            'pgw_trace_ref' => '20000445-7572eef90f922e2529c2f813ba4edeaa-20150707112327024',
            'pgw_order_id' => '559b9a4c78d29',
            'pgw_merchant_data' => '',
            'pgw_signature' => '5f61773a2dca6d4a57797efc0171116ed608e7c5c78e9880bea5d9e8459efa2acf30360866b303c37b8ce63770a04a88ebfbd8b05a6814247667d75940e64a66',
        );

        $this->assertEquals(
            '8b42902e9e09218f032336d3ca041df8a650e0705cfee50798123a48203194e670ceb0247e45f106e9fb8324e9e501bbe749ccbe5aafebd903c2b85a50bb2d46',
            SignatureGenerator::generateSignatureFromArray('new-secret-key', $response)
        );
    }

    /**
     * Testing signature generator for authorization announce
     */
    public function testAuthorizationAnnounceSignatureGenerator()
    {
        $data = array(
            'method' => 'authorization-announce',
            'pgw_shop_id' => 12345,
            'pgw_order_id' => 'order-123',
            'pgw_amount' => 195000,
            'pgw_authorization_type' => 0,
            'pgw_announcement_duration' => '',
        );

        $this->assertEquals(
            '991b82487c5540001a33accd47d9de0023f4c6d0a7ccb0884ec96d6c0609a4625ee5203d358903386247b3ac40a888b66bf248250a3fc4bb21634857e4229795',
            SignatureGenerator::generateSignatureFromArray('secretkey', $data)
        );

        $data['pgw_announcement_duration'] = 30;

        $this->assertEquals(
            'b6d71c301489d5584ec9e4ec63634ade433a9ad24a09a94874f117f39049307f3c85517e754c1202609479cf803565ab77c7c41078527928e76605fb5286a9e0',
            SignatureGenerator::generateSignatureFromArray('secretkey', $data)
        );
    }

//    /**
//     * Testing signature generator for authorization announce
//     */
//    public function testAuthorizationCompleteSignatureGenerator()
//    {
//        $payment = new Payment(
//            12345,
//            'secretkey',
//            'order-123',
//            195000,
//            0,
//            'http://www.mojducan.com/success/order-no-135',
//            'http://www.mojducan.com/failure/order-no-135',
//            '111111111111111',
//            '1812',
//            '123',
//            'John',
//            'Smith',
//            'Street 49',
//            'Locastic City',
//            '1911',
//            'LocasticLand',
//            'email@example.com'
//        );
//
//        $this->assertEquals(
//            '29602e9d87f1fc433577511fdfefdec913f58e567449899097523d791c2579a6b003d41c38e0350787ef6d13e6f7f9312e425c424d19f92c6e86528ea4b31d94',
//            SignatureGenerator::generateAuthorizationCompleteSignature($payment, '123')
//        );
//    }
//
//    /**
//     * Testing signature generator for authorization announce
//     */
//    public function testAuthorizationCancelSignatureGenerator()
//    {
//        $payment = new Payment(
//            12345,
//            'secretkey',
//            'order-123',
//            195000,
//            0,
//            'http://www.mojducan.com/success/order-no-135',
//            'http://www.mojducan.com/failure/order-no-135',
//            '111111111111111',
//            '1812',
//            '123',
//            'John',
//            'Smith',
//            'Street 49',
//            'Locastic City',
//            '1911',
//            'LocasticLand',
//            'email@example.com'
//        );
//
//        $this->assertEquals(
//            '1b50c5c8bd8337983eb8206061272d72f1996aaaab7313884a2c62625fb1d62c696579d29a4a665aedd71a964e472861c6f8d8a7c4916d635c7781c798028085',
//            SignatureGenerator::generateAuthorizationCancelSignature($payment, '123')
//        );
//    }
//
//    /**
//     * Testing signature generator for authorization announce
//     */
//    public function testAuthorizationRefundSignatureGenerator()
//    {
//        $payment = new Payment(
//            12345,
//            'secretkey',
//            'order-123',
//            195000,
//            0,
//            'http://www.mojducan.com/success/order-no-135',
//            'http://www.mojducan.com/failure/order-no-135',
//            '111111111111111',
//            '1812',
//            '123',
//            'John',
//            'Smith',
//            'Street 49',
//            'Locastic City',
//            '1911',
//            'LocasticLand',
//            'email@example.com'
//        );
//
//        $this->assertEquals(
//            '24ed811be287e9a201e9ef01d839af2862808575e0bcd41dd2afcdab6cb14dff0cfe97c27a9fa640a04e279275b3ca4fd1c985d2bac7816b0d140cf634cab724',
//            SignatureGenerator::generateAuthorizationRefundSignature($payment, '123')
//        );
//    }
//
//    /**
//     * Testing signature generator for authorization announce
//     */
//    public function testAuthorizationInfoSignatureGenerator()
//    {
//        $payment = new Payment(
//            12345,
//            'secretkey',
//            'order-123',
//            195000,
//            0,
//            'http://www.mojducan.com/success/order-no-135',
//            'http://www.mojducan.com/failure/order-no-135',
//            '111111111111111',
//            '1812',
//            '123',
//            'John',
//            'Smith',
//            'Street 49',
//            'Locastic City',
//            '1911',
//            'LocasticLand',
//            'email@example.com'
//        );
//
//        $this->assertEquals(
//            '508916100f87fd98ae077909d5a39b90891f2b1b5257b57e232f3e16c46487e4929e9b7c8d3af06c7b3b2498a50ee8b83dcd6c75e61bfab9056fb3b12171e9c9',
//            SignatureGenerator::generateAuthorizationInfoSignature($payment, '123')
//        );
//    }
}
