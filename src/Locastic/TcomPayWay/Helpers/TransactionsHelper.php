<?php

namespace Locastic\TcomPayWay\Helpers;

use Locastic\TcomPayWay\Model\Transaction;

final class TransactionsHelper
{
    const TRANSACTION_SIGNATURE_ALGO = 'md5';

    public static function signTransaction(Transaction $transaction)
    {
        $shop = $transaction->getShop();

        $shopId = $shop->getId();
        $secretKey = $shop->getSecretKey();

        $payment = $transaction->getPayment();

        $amount = $payment->getAmount();
        $shoppingCartId = $payment->getShoppingCartId();

        $modifiedAmount = self::modifyAmount($amount);

        // compute hash

        $data = $shopId . $secretKey . $shoppingCartId . $secretKey . $modifiedAmount . $secretKey;

        return hash(self::TRANSACTION_SIGNATURE_ALGO, $data);
    }

    private static function modifyAmount($amount)
    {
        return number_format($amount / 100, 2, ',', '');
    }

    public static function clearUTF($s)
    {
        setlocale(LC_ALL, 'en_US.UTF8');

        // original source: http://php.net/manual/en/function.iconv.php#83238

        $r = '';
        $s1 = iconv('UTF-8', 'ASCII//TRANSLIT', $s);
        for ($i = 0; $i < strlen($s1); $i++)
        {
            $ch1 = $s1[$i];
            $ch2 = mb_substr($s, $i, 1);

            $r .= $ch1=='?'?$ch2:$ch1;
        }

        return $r;
    }

}