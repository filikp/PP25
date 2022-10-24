<?php

class Kupci
{
    public static function readOne($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        select * from kupac where sifra=:sifra

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
        
            select * from kupac order by prezime
        
        ');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function create($kupac)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        insert into 
        kupac (ime, prezime, mobitel)
        values (:ime, :prezime, :mobitel)
        
        ');
        $izraz->execute($kupac);
    }
}