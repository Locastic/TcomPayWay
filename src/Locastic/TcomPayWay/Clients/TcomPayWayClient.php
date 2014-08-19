<?php

namespace Locastic\TcomPayWay\Clients;

class TcomPayWayClient extends SoapClient implements SoapClientInterface, TcomPayWayClientInterface
{
    public function initClient($wsdlUrl, $options)
    {
        $this->soapClient = new \SoapClient($wsdlUrl, $options);
    }

    public function SendSecure3DRequestExtn($shopId, $shopUsername, $shopPassword, $amount, $cardId, $cardNumber, $cardExpDate, $numOfInstallments, $httpAccept, $httpUserAgent, $orginIp)
    {
        return $this->soapClient
            ->SendSecure3DRequestExtn(
                array(
                    'shopID'                => $shopId,
                    'shopUsername'          => $shopUsername,
                    'shopPassword'          => $shopPassword,
                    'amount'                => $amount,
                    'cardID'                => $cardId,
                    'cardNumber'            => $cardNumber,
                    'cardExpirationDate'    => $cardExpDate,
                    'numberOfInstallments'  => $numOfInstallments,
                    'httpAccept'            => $httpAccept,
                    'httpUserAgent'         => $httpUserAgent,
                    'orginIp'               => $orginIp,
                )
            )
            ->SendSecure3DRequestExtnResult
        ;
    }

    public function ProcessAuthorizationExt($shopId, $shopUsername, $shopPassword, $firstName, $lastName, $street, $city, $postalCode, $country, $phoneNumber, $email, $cardId, $cardNumber, $cardExpirationDate, $cardCVD, $shoppingCartId, $totalAmount, $paymentMode, $signature, $secure3DPARes, $numberOfInstallments, $httpAccept, $httpUserAgent, $originIp)
    {
        return $this->soapClient
            ->ProcessAuthorizationExt(array(
                'shopID'                => $shopId,
                'shopUsername'          => $shopUsername,
                'shopPassword'          => $shopPassword,
                'firstName'             => $firstName,
                'lastName'              => $lastName,
                'street'                => $street,
                'city'                  => $city,
                'postalCode'            => $postalCode,
                'country'               => $country,
                'phoneNumber'           => $phoneNumber,
                'email'                 => $email,
                'cardID'                => $cardId,
                'cardNumber'            => $cardNumber,
                'cardExpirationDate'    => $cardExpirationDate,
                'cardCVD'               => $cardCVD,
                'shoppingCartId'        => $shoppingCartId,
                'totalAmount'           => $totalAmount,
                'paymentMode'           => $paymentMode,
                'signature'             => $signature,
                'secure3DPARes'         => $secure3DPARes,
                'numberOfInstallments'  => $numberOfInstallments,
                'httpAccept'            => $httpAccept,
                'httpUserAgent'         => $httpUserAgent,
                'originIp'              => $originIp
            ))
            ->ProcessAuthorizationExtResult;
        ;
    }

    public function ProcessReversalEx($shopId, $shopUsername, $shopPassword, $transactionId, $signature, $originIp)
    {
        return $this->soapClient
            ->ProcessReversalEx(array(
                'shopId'        => $shopId,
                'shopUsername'  => $shopUsername,
                'shopPassword'  => $shopPassword,
                'transactionId' => $transactionId,
                'signature'     => $signature,
                'originIp'      => $originIp
            ))
        ;
    }

    public function ProcessSettlementEx($shopId, $shopUsername, $shopPassword, $transactionId, $amount, $signature, $originIp)
    {
        return $this->soapClient
            ->ProcessSettlementEx(array(
                'shopId'        => $shopId,
                'shopUsername'  => $shopUsername,
                'shopPassword'  => $shopPassword,
                'transactionId' => $transactionId,
                'amount'        => $amount,
                'signature'     => $signature,
                'originIp'      => $originIp
            ))
        ;
    }

    public function GetValidInstallments($shopId, $shopUsername, $shopPassword, $cardNumber, $amount)
    {
        return $this->soapClient
            ->GetValidInstallments(array(
                'shopID'        => $shopId,
                'shopUsername'  => $shopUsername,
                'shopPassword'  => $shopPassword,
                'cardNumber'    => $cardNumber,
                'amount'        => $amount
            ))
            ->GetValidInstallmentsResult
        ;
    }

}