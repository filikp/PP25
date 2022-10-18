<?php

class Racun
{
    public static function readOne($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        select * from racun where sifra=:sifra

        ');
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
        
            select * from racun order by -vrijeme_kupnje
        
        ');
        $izraz->execute(); // OVO MORA BITI OBAVEZNO
        return $izraz->fetchAll(); // vraća indeksni niz objekata tipa stdClass
    }
}