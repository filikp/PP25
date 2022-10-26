<?php

class Kupci
{

    public static function brisanje($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            select count(*) from racun where kupac=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
        $ukupno = $izraz->fetchColumn();
        return $ukupno==0; 
    }

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
        
        select a.sifra, a.ime, a.prezime, a.mobitel,  count(b.sifra) as racuna
        from kupac a left join racun b 
        on a.sifra = b.kupac
        group by a.sifra, a.ime, a.prezime, a.mobitel
        order by 1,2;
            
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

    public static function update($kupac)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            update kupac set
                ime=:ime,
                prezime=:prezime,
                mobitel=:mobitel
                    where sifra=:sifra
        ');
        $izraz->execute($kupac);
    }

    public static function delete($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            delete from kupac where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
    }
}