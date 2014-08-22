<?php

namespace Locastic\TcomPayWay\Helpers;

final class CardHelper
{
    public static function getCardId($cardNumber){
        $id = 'Unknown';

        $firstDigit = $result = substr($cardNumber, 0, 1);
        $firstTwoDigits = $result = substr($cardNumber, 0, 2);
        $firstThreeDigits = $result = substr($cardNumber, 0, 3);

        if ($firstDigit == '4') {
            $id = 'VISA';
        }

        if ($firstDigit == '6') {
            $id = 'Maestro';
        }

        switch ($firstTwoDigits) {
            case '34':
            case '37':
                $id = 'AMEX';
                break;
            case '36':
            case '38':
                $id = 'Diners';
                break;
            case '51':
            case '52':
            case '53':
            case '54':
            case '55':
                $id = 'Maestro';
                break;
            case '50':
            case '56':
            case '57':
            case '58':
                $id = 'Maestro';
        }

        if ($firstThreeDigits == '300' or $firstThreeDigits == '301' or $firstThreeDigits == '302' or
            $firstThreeDigits == '303' or $firstThreeDigits == '304' or $firstThreeDigits == '305') {
            $id = 'Diners';
        }

        return $id;
    }
}