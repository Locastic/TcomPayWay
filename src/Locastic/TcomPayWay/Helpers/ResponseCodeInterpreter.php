<?php

namespace Locastic\TcomPayWay\Helpers;

/**
 * Get code translated to human language
 *
 * Class MiscHelper
 * @package Locastic\TcomPayWay\Helpers\ResponseCodeInterpreter
 */
class ResponseCodeInterpreter
{
    /**
     * @param int $pgwResultCode
     * @return string
     */
    public static function getPgwResultCode($pgwResultCode)
    {
        $pgwResultCodes = array(
            '0' => 'Akcija uspješna',
            '1' => 'Akcija neuspješna',
            '2' => 'Greška prilikom obrade',
            '3' => 'Akcija otkazana',
            '4' => 'Akcija neuspješna (3D Secure MPI)',
            '1000' => 'Neispravan potpis (pgw_signature)',
            '1001' => 'Neispravan ID dućana (pgw_shop_id)',
            '1002' => 'Neispravan ID transakcija (pgw_transaction_id)',
            '1003' => 'Neispravan iznos (pgw_amount)',
            '1004' => 'Neispravan tip autorizacije (pgw_authorization_type)',
            '1005' => 'Neispravno trajanje najave autorizacije (pgw_announcement_duration)',
            '1006' => 'Neispravan broj rata (pgw_installments)',
            '1007' => 'Neispravan jezik (pgw_language)',
            '1008' => 'Neispravan autorizacijski token (pgw_authorization_token)',
            '1100' => 'Neispravan broj kartice (pgw_card_number)',
            '1101' => 'Neispravan datum isteka kartice (pgw_card_expiration_date)',
            '1102' => 'Neispravan verifikacijski broj kartice (pgw_card_verification_data)',
            '1200' => 'Neispravan ID narudžbe (pgw_order_id)',
            '1201' => 'Neispravan info narudžbe (pgw_order_info)',
            '1202' => 'Neispravne stavke narudžbe (pgw_order_items)',
            '1300' => 'Neispravan način povrata na dućan (pgw_return_method)',
            '1301' => 'Neispravan povratni url na dućan (pgw_success_url)',
            '1302' => 'Neispravan povratni url na dućan (pgw_failure_url)',
            '1304' => 'Neispravni podaci trgovca (pgw_merchant_data)',
            '1400' => 'Neispravno ime kupca (pgw_first_name)',
            '1401' => 'Neispravno prezime kupca (pgw_last_name)',
            '1402' => 'Neispravna adresa (pgw_street)',
            '1403' => 'Neispravni grad (pgw_city)',
            '1404' => 'Neispravni poštanski broj (pgw_post_code)',
            '1405' => 'Neispravna država (pgw_country)',
            '1406' => 'Neispravan kontakt telefon (pgw_telephone)',
            '1407' => 'Neispravna kontakt e-mail adresa (pgw_email)',
        );

        return $pgwResultCodes[$pgwResultCode];
    }

    /**
     * @param int $pgwResultCode
     * @return string
     */
    public static function getPgwResultCodeWithoutFields($pgwResultCode)
    {
        $pgwResultCodes = array(
            '0' => 'Akcija uspješna',
            '1' => 'Akcija neuspješna',
            '2' => 'Greška prilikom obrade',
            '3' => 'Akcija otkazana',
            '4' => 'Akcija neuspješna (3D Secure MPI)',
            '1000' => 'Neispravan potpis',
            '1001' => 'Neispravan ID dućana',
            '1002' => 'Neispravan ID transakcija',
            '1003' => 'Neispravan iznos',
            '1004' => 'Neispravan tip autorizacije',
            '1005' => 'Neispravno trajanje najave autorizacije',
            '1006' => 'Neispravan broj rata',
            '1007' => 'Neispravan jezik',
            '1008' => 'Neispravan autorizacijski token',
            '1100' => 'Neispravan broj kartice',
            '1101' => 'Neispravan datum isteka kartice',
            '1102' => 'Neispravan verifikacijski broj kartice',
            '1200' => 'Neispravan ID narudžbe',
            '1201' => 'Neispravan info narudžbe',
            '1202' => 'Neispravne stavke narudžbe',
            '1300' => 'Neispravan način povrata na dućan',
            '1301' => 'Neispravan povratni url na dućan',
            '1302' => 'Neispravan povratni url na dućan',
            '1304' => 'Neispravni podaci trgovca',
            '1400' => 'Neispravno ime kupca',
            '1401' => 'Neispravno prezime kupca',
            '1402' => 'Neispravna adresa',
            '1403' => 'Neispravni grad',
            '1404' => 'Neispravni poštanski broj',
            '1405' => 'Neispravna država',
            '1406' => 'Neispravan kontakt telefon',
            '1407' => 'Neispravna kontakt e-mail adresa',
        );

        return $pgwResultCodes[$pgwResultCode];
    }
}
