<?php

namespace Locastic\TcomPayWay\Clients;

interface TcomPayWayClientInterface
{
    public function SendSecure3DRequestExtn($shopId, $shopUsername, $shopPassword, $amount, $cardId, $cardNumber, $cardExpDate, $numOfInstallments, $httpAccept, $httpUserAgent, $orginIp);

    public function ProcessAuthorizationExt($shopId, $shopUsername, $shopPassword, $firstName, $lastName, $street, $city, $postalCode, $country, $phoneNumber, $email, $cardId, $cardNumber, $cardExpirationDate, $cardCVD, $shoppingCartId, $totalAmount, $paymentMode, $signature, $secure3DPARes, $numberOfInstallments, $httpAccept, $httpUserAgent, $originIp);

    public function ProcessReversalEx($shopId, $shopUsername, $shopPassword, $transactionId, $signature, $originIp);

    public function ProcessSettlementEx($shopId, $shopUsername, $shopPassword, $transactionId, $amount, $signature, $originIp);

    public function GetValidInstallments($shopId, $shopUsername, $shopPassword, $cardNumber, $amount);
}