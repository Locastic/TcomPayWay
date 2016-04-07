HP PayWay API (TcomPayWay)
===================

#Installation
Add repository to composer.json
```
"repositories": [
        {
            "url": "https://github.com/locastic/TcomPayWay.git",
            "type": "git"
        }
    ],
```
And inside "require"
`"locastic/tcompayway": "@dev"`

and use `composer install`


#Usage (Form)

`use Locastic\TcomPayWay\AuthorizeForm\Model\Payment;`

###Create object & populate data
```
$payment = new Payment(
    '1234556', //shop id
    'payway_secret',
    'order_id', //must be unique for each payment
    123, //amount
    0,
    'http://www.mojducan.com/success/narudžba456',
    'http://www.mojducan.com/failure/narudžba456'
    );
$payment->setPgwFirstName('name');
$payment->setPgwLastName('surname');
$payment->setPgwStreet('street');
$payment->setPgwPostCode('1234');
$payment->setPgwCity('Maribor');
$payment->setPgwCountry('Slovenia');
$payment->setPgwEmail('my.email@test.com');
$payment->setPgwPhoneNumber('1234567');

$payment->setPgwDisableInstallments(1);
$payment->setPgwAuthorizationType(0);
$payment->setPgwAuthorizationToken('');
$payment->setPgwReturnMethod('GET');
$payment->setPgwmerchantData('');
$payment->setPgwOrderInfo('');
$payment->setPgwOrderItems('');
$payment->setPgwLanguage('en');
```

###Small test example on how send data (with Laravel 5)
```
{!! Form::open(['method' => 'POST', 'url' => 'https://pgwtest.ht.hr/services/payment/api/authorize-form']) !!}
	
{!! Form::hidden('pgw_shop_id', $payment->getPgwShopId()) !!}
{!! Form::hidden('pgw_order_id', $payment->getPgwOrderId()) !!}
{!! Form::hidden('pgw_language', $payment->getPgwLanguage()) !!}
{!! Form::hidden('pgw_amount', $payment->getPgwAmount()) !!}
{!! Form::hidden('pgw_authorization_type', $payment->getPgwAuthorizationType()) !!}
{!! Form::hidden('pgw_success_url', $payment->getPgwSuccessUrl()) !!}
{!! Form::hidden('pgw_failure_url', $payment->getPgwFailureUrl()) !!}
{!! Form::hidden('pgw_signature', Locastic\TcomPayWay\AuthorizeForm\Helpers\SignatureGenerator::generateSignature($payment)) !!}

{!! Form::hidden('pgw_authorization_token', $payment->getPgwAuthorizationToken()) !!}
{!! Form::hidden('pgw_return_method', $payment->getPgwReturnMethod()) !!}
{!! Form::hidden('pgw_first_name', $payment->getPgwFirstName()) !!}
{!! Form::hidden('pgw_last_name', $payment->getPgwLastName()) !!}
{!! Form::hidden('pgw_street', $payment->getPgwStreet()) !!}
{!! Form::hidden('pgw_city', $payment->getPgwCity()) !!}
{!! Form::hidden('pgw_post_code', $payment->getPgwPostCode()) !!}
{!! Form::hidden('pgw_country', $payment->getPgwCountry()) !!}
{!! Form::hidden('pgw_telephone', $payment->getPgwPhoneNumber()) !!}
{!! Form::hidden('pgw_email', $payment->getPgwEmail()) !!}
{!! Form::hidden('pgw_merchant_data', $payment->getPgwmerchantData()) !!}
{!! Form::hidden('pgw_order_info', $payment->getPgwOrderInfo()) !!}
{!! Form::hidden('pgw_order_items', $payment->getPgwOrderItems()) !!}
{!! Form::hidden('pgw_disable_installments', $payment->getPgwDisableInstallments()) !!}

{!! Form::submit("Add", ['class' => 'btn btn-success']) !!}


{!! Form::close() !!}
```

###Reading response (example for Laravel 5.1)

```
$payment = new Payment(
    '1234556', //shop id
    'payway_secret',
    'order_id', //must be unique for each payment
    123, //amount
    0,
    'http://www.mojducan.com/success/narudžba456',
    'http://www.mojducan.com/failure/narudžba456'
    );

$payment->isPgwOrderedResponseValid($request->all()); //true or false
//or
$payment->isPgwResponseValid($request->all()); //true or false
```
