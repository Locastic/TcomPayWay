<?php

use Locastic\TcomPayWay\Helpers\MiscHelper;

class MiscHelperTest extends PHPUnit_Framework_TestCase
{
    /**
     * Testing password generator
     */
    public function testClearingUtf()
    {
        $string = 'Žž Ćć Čč ćž ĆŽ';

        $this->assertEquals('Zz Cc Cc cz CZ', MiscHelper::clearUTF($string));

        $string = 'Pero Perić Žićo';

        $this->assertEquals('Pero Peric Zico', MiscHelper::clearUTF($string));
    }
}
