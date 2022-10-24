<?php

class Stavka
{
    public static function readOne($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('

        select a.proizvodac, a.cijena_kn, b.kolicina
        from bicikl a inner join stavka b 
        on a.sifra = b.bicikl
        where a.sifra=:sifra

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

        select a.proizvodac, a.cijena_kn, b.kolicina
        from bicikl a inner join stavka b 
        on a.sifra = b.bicikl
        order by a.proizvodac
        
        ');
        // select a.sifra, b.proizvodac, a.kolicina, a.racun
        // from stavka a left join
        // bicikl b on a.bicikl = b.sifra
        // order by a.sifra
        $izraz->execute();
        return $izraz->fetchAll(); // vraća indeksni niz objekata tipa stdClass
    }

    public static function create($s)
    {

        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        insert into stavka
            (bicikl,kolicina)
            values
            (:bicikl,:kolicina);
        
        ');
        $izraz->execute($s);
        return $veza->lastInsertId();
    }
}