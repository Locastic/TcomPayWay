<?php

namespace Locastic\TcomPayWay\Helpers;

/**
 * Used for small conversions of strings and etc
 *
 * Class MiscHelper
 * @package Locastic\TcomPayWay\AuthorizeForm\Helpers
 */
class MiscHelper
{
    public static function clearUTF($s)
    {
        setlocale(LC_ALL, 'en_US.UTF8');
        // original source: http://php.net/manual/en/function.iconv.php#83238

        $r = '';
        $s1 = iconv('UTF-8', 'ASCII//TRANSLIT', $s);

        for ($i = 0; $i < strlen($s1); $i++) {
            $ch1 = $s1[$i];
            $ch2 = mb_substr($s, $i, 1);
            $r .= $ch1 == '?' ? $ch2 : $ch1;
        }

        return $r;
    }
}
