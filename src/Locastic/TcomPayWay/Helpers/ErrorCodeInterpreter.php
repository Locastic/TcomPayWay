<?php

namespace Locastic\TcomPayWay\Helpers;

final class ErrorCodeInterpreter
{
    public static function getReturnCode($code)
    {
        $returnCodes = array(
            0 => 'Akcija uspješno izvršena (bez greške)',
            1 => 'Neobrađena pogreška',
            2 => 'Nepodržani tip poruke',
            3 => 'Neodgovarajuća vrsta odgovora',
            4 => 'Jedinstveni identifikatori poruka se ne podudaraju',
            5 => 'Isteklo vrijeme zahtjeva',
            6 => 'Pogreška prilikom slanja zahtjeva',
            7 => 'Odbijena kartica',
            8 => 'Istekao datum valjanosti kartice',
            9 => 'Ograničena kartica',
            10 => 'Prekoračen broj neispravnih upisa PIN-a',
            11 => 'Nepoznati tip kartice',
            12 => 'Akcija nije podržana',
            13 => 'Neispravan PIN',
            14 => 'Prekoračen limit',
            15 => 'Odbijeno otkazivanje predautorizacije',
            16 => 'Veza u prekidu',
            17 => 'Prijava na sustav odbijena',
            18 => 'Nepoznati trgovac',
            19 => 'Pogreška prilikom pristupa bazi podataka',
            20 => 'Neispravan iznos',
            21 => 'Odbijeno plaćanje na rate',
            22 => 'Pogrešno uneseni podaci trgovine',
            23 => 'Trgovina nije aktivna',
            24 => 'Pogrešna oznaka trgovine',
            25 => 'Pogrešno uneseni podaci o korisniku',
            26 => 'Pogrešno uneseno ime korisnika',
            27 => 'Pogrešno uneseno prezime korisnika',
            28 => 'Pogrešno unesena adresa korisnika',
            29 => 'Pogrešno unesen grad korisnika',
            30 => 'Pogrešno unesen poštanski broj korisnika',
            31 => 'Pogrešno unesena država korisnika',
            32 => 'Pogrešno unesen broj telefona korisnika',
            33 => 'Pogrešno unesena e-mail adresa korisnika',
            34 => 'Pogrešno uneseni podaci o kreditnoj kartici',
            35 => 'Pogrešno unesen tip kreditne kartice',
            36 => 'Pogrešno unesen CVD broj',
            37 => 'Pogrešno unesen datum isteka valjanosti kreditne kartice',
            38 => 'Pogrešno unesen broj kreditne kartice',
            39 => 'Neispravan potpis transakcije',
            40 => 'Pogrešno unesen ukupan iznos',
            41 => 'Pogrešno unesena oznaka košarice',
            42 => 'Pogrešno unesena oznaka transakcije',
            43 => 'Pogreška prilikom prijave na sustav (neispravno korisničko ime ili zaporka)',
            44 => 'Pogreška unutar 3DSecure programa',
            45 => 'Ne postoji prodajno mjesto (neispravna kombinacija iznosa/rata)',
            46 => 'Odbijeno naplaćivanje predautorizacije',
            47 => 'Transakcija se već procesira',
            48 => 'Odbijena kartica (ECI7)',
        );


        return $returnCodes[$code];
    }

    public static function getSecure3DreturnCode($code)
    {
        $secure3DreturnCode = array(
            1 => 'Potrebna je provjera identiteta korisnika',
            2 => 'Neobrađena pogreška prilikom obrade transakcije',
            3 => 'Kreditna kartica ne participira u programu',
            4 => 'Nije potrebna provjera identiteta korisnika',
            5 => 'Onemogućen proces',
            6 => 'Pogreška prilikom prihvata odgovora od strane izdavatelja kartice',
            7 => 'Pogrešan digitalni potpis transakcije',
            8 => 'Korisnik nije prošao provjeru identiteta',
            9 => 'Sistemska pogreška',
            10 => 'Pogrešan digitalni potpis izdavatelja kartice',
        );

        return $secure3DreturnCode[$code];
    }

}