<?php

class Prodavac
{

    public static function brisanje($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            select count(*) from racun where prodavac=:sifra
        
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
        
        select * from prodavac where sifra=:sifra

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
        
            select a.sifra, a.ime, a.prezime, a.email, a.OIB, a.IBAN,  count(b.sifra) as racuna
            from prodavac a left join racun b 
            on a.sifra = b.prodavac
            group by a.sifra, a.ime, a.prezime, a.email, a.OIB, a.IBAN
            order by 1,2;
        
        ');
        $izraz->execute(); // OVO MORA BITI OBAVEZNO
        return $izraz->fetchAll(); // vraća indeksni niz objekata tipa stdClass
    }


    public static function create($prodavac)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        insert into 
        prodavac (ime, prezime, email, OIB, IBAN)
        values (:ime, :prezime, :email, :OIB, :IBAN)
        
        ');
        $izraz->execute($prodavac);
    }

    public static function update($prodavac)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            update prodavac set
                ime=:ime,
                prezime=:prezime,
                email=:email,
                OIB=:OIB,
                IBAN=:IBAN
                    where sifra=:sifra
        ');
        $izraz->execute($prodavac);
    }

    public static function delete($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            delete from prodavac where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
    }
}