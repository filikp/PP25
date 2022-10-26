<?php

class Racun
{
    public static function readOne($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        select concat(p.ime, \' \', p.prezime) as prodavac, r.vrijeme_kupnje,
        concat(k.ime, \' \', k.prezime) as kupac, k.mobitel, b.proizvodac, b.cijena_kn, s.kolicina
        from prodavac p inner join racun r 
        on p.sifra = r.prodavac  
        inner join kupac k
        on k.sifra = r.kupac 
        inner join stavka s 
        on s.sifra = r.stavka 
        inner join bicikl b 
        on b.sifra = s.bicikl
        where b.sifra=:sifra

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
        
        select concat(p.ime, \' \', p.prezime) as prodavac, r.vrijeme_kupnje,
        concat(k.ime, \' \', k.prezime) as kupac, k.mobitel, b.proizvodac, b.cijena_kn, s.kolicina
        from prodavac p inner join racun r 
        on p.sifra = r.prodavac  
        inner join kupac k
        on k.sifra = r.kupac 
        inner join stavka s 
        on s.racun = r.sifra 
        inner join bicikl b 
        on b.sifra = s.bicikl
        order by b.cijena_kn
        
        ');
        $izraz->execute();
        return $izraz->fetchAll();
    }
}