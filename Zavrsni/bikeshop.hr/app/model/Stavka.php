<?php

class Stavka
{
    public static function readOne($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('

        select a.proizvodac, a.namjena, a.elektricni, a.broj_brzina, a.velicina_cm, a.cijena_kn, b.kolicina, b.racun
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

        select a.sifra, a.proizvodac, a.namjena, a.elektricni, a.broj_brzina, a.velicina_cm, a.cijena_kn, b.kolicina, b.racun
        from bicikl a inner join stavka b 
        on a.sifra = b.bicikl
        group by a.sifra, a.proizvodac, a.namjena, a.elektricni, a.broj_brzina, a.velicina_cm, a.cijena_kn, b.kolicina, b.racun
        order by 1,2
        
        ');

        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function create($p)
    {

        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        insert into stavka
            (bicikl, kolicina)
            values
            (:bicikl, :kolicina)
        
        ');
        $izraz->execute([
            'bicikl'=>$p['bicikl'],
            'kolicina'=>$p['kolicina']
        ]);
        return $veza->lastInsertId();
    }

    public static function update($p)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        update stavka set
            bicikl=:bicikl,
            kolicina=:kolicina
        where sifra=:sifra;
        
        ');
        $izraz->execute($p);
    }

    public static function delete($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
           delete from stavka where sifra=:sifra 
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
    }

    public static function dodajbicikl($vrijeme_kupnje, $prodavac, $kupac, $stavka)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
           insert into racun(vrijeme_kupnje, prodavac, kupac, stavka) values
           (:vrijeme_kupnje,:prodavac, :kupac, :stavka)
        
        ');
        $izraz->execute([
            'vrijeme_kupnje'=>$vrijeme_kupnje,
            'prodavac'=>$prodavac,
            'kupac'=>$kupac,
            'stavka'=>$stavka
        ]);
    }

    public static function obrisibicikl($vrijeme_kupnje, $prodavac, $kupac, $stavka)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
          delete from racun where vrijeme_kupnje=:vrijeme_kupnje 
          and prodavac=:prodavac and kupac=:kupac and stavka=:stavka
        
        ');
        $izraz->execute([
            'vrijeme_kupnje'=>$vrijeme_kupnje,
            'prodavac'=>$prodavac,
            'kupac'=>$kupac,
            'stavka'=>$stavka
        ]);
    }
}