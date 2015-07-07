<?php

namespace Locastic\TcomPayWay\Helpers;

/**
 * Get name of card by pgw card type code
 *
 * Class MiscHelper
 * @package Locastic\TcomPayWay\Helpers\CardTypeInterpreter
 */
class CardTypeInterpreter
{
    /**
     * @param int $pgwCardTypeCode
     * @return string
     */
    public static function getPgwCardType($pgwCardTypeCode)
    {
        $pgwCardTypes = array(
            '1' => 'American Express',
            '2' => 'MasterCard',
            '3' => 'Visa',
            '4' => 'Diners',
            '5' => 'Maestro',

        );

        return $pgwCardTypes[$pgwCardTypeCode];
    }
}
