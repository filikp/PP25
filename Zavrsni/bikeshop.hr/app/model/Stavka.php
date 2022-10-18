<?php

class Stavka
{
    public static function readOne($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('

        select * from stavka where sifra=:sifra

        ');
        // select a.sifra, b.proizvodac, a.kolicina, c.sifra
        // from stavka a inner join
        // bicikl b inner join 
        // racun c on a.stavka = b.sifra
        // a.stavka = c.sifra
        // where a.sifra=:sifra
        $izraz->execute([
            'sifra'=>$sifra
        ]);
        return $izraz->fetch();
    }

    // CRUD - R
    public static function read()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('

        select * from stavka order by -kolicina
        
        ');
        // select a.sifra, b.proizvodac, a.kolicina, a.racun
        // from stavka a left join
        // bicikl b on a.bicikl = b.sifra
        // order by a.sifra
        $izraz->execute(); // OVO MORA BITI OBAVEZNO
        return $izraz->fetchAll(); // vraća indeksni niz objekata tipa stdClass
    }
}