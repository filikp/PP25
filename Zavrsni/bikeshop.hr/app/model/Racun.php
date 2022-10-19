<?php

class Racun
{
    public static function readOne($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        select p.ime as ime_prodavaca, p.prezime as prezime_prodavaca, r.vrijeme_kupnje, 
        k.ime as ime_kupca, k.prezime as prezime_kupca, k.mobitel, b.proizvodac, b.cijena_kn, s.kolicina
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
        
        select p.ime as ime_prodavaca, p.prezime as prezime_prodavaca, r.vrijeme_kupnje, 
        k.ime as ime_kupca, k.prezime as prezime_kupca, k.mobitel, b.proizvodac, b.cijena_kn, s.kolicina
        from prodavac p inner join racun r 
        on p.sifra = r.prodavac  
        inner join kupac k
        on k.sifra = r.kupac 
        inner join stavka s 
        on s.sifra = r.stavka 
        inner join bicikl b 
        on b.sifra = s.bicikl
        order by b.cijena_kn
        
        ');
        $izraz->execute();
        return $izraz->fetchAll(); // vraća indeksni niz objekata tipa stdClass
    }
}