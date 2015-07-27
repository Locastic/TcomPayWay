<?php

use Locastic\TcomPayWay\AuthorizeDirect\Api;

class PaymentTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test creating with all paramters
     *
     * @test
     */
    public function couldBeConstructedWithAllParameters()
    {
        $api = new Api(
            'username',
            'password',
            1234,
            'secretkey',
            1,
            false
        );

        $this->assertInstanceOf('Locastic\TcomPayWay\AuthorizeDirect\Api', $api);
    }

    /**
     * @test
     *
     * @expectedException \LogicException
     * @expectedExceptionMessage The username and password must be strings.
     */
    public function throwIfUsernameNotStringInConstructor()
    {
        new Api(
            123,
            'password',
            1234,
            'secretkey',
            1,
            false
        );
    }


    /**
     * @test
     *
     * @expectedException \LogicException
     * @expectedExceptionMessage The username and password must be strings.
     */
    public function throwIfPasswordNotStringInConstructor()
    {
        new Api(
            'username',
            2121,
            1234,
            'secretkey',
            1,
            false
        );
    }

    /**
     * @test
     *
     * @expectedException \LogicException
     * @expectedExceptionMessage The integer Shop ID option must be set.
     */
    public function throwIfShopIdNotIntegerInConstructor()
    {
        new Api(
            'username',
            'password',
            'DSS',
            'secretkey',
            1,
            451
        );
    }

    /**
     * @test
     *
     * @expectedException \LogicException
     * @expectedExceptionMessage The boolean sandbox option must be set.
     */
    public function throwIfSandboxNotBooleanInConstructor()
    {
        new Api(
            'username',
            'password',
            1234,
            'secretkey',
            1,
            451
        );
    }

}
