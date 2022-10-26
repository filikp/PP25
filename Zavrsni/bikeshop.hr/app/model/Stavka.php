<?php

class Stavka
{
    public static function readOne($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('

        select a.sifra, a.kolicina, a.racun, b.proizvodac, b.namjena, 
        b.elektricni, b.broj_brzina, b.velicina_cm, b.cijena_kn
        from stavka a inner join bicikl b 
        on a.bicikl = b.sifra
        where sifra=:sifra

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

        select a.sifra, a.kolicina, b.proizvodac, b.namjena, b.elektricni, 
        b.broj_brzina, b.velicina_cm, b.cijena_kn, count(c.sifra) as racuni
        from stavka a inner join bicikl b 
        on a.bicikl = b.sifra
        left join racun c
        on c.sifra = a.racun
        group by a.sifra, a.kolicina, a.racun, b.proizvodac, b.namjena, b.elektricni, 
        b.broj_brzina, b.velicina_cm, b.cijena_kn
        order by 1,4;
        
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
        ');

        // $izraz = $veza->prepare('
        
        // insert into bicikl
        //     (proizvodac, namjena, elektricni, broj_brzina, velicina_cm, cijena_kn)
        //     values
        //     (:proizvodac, :namjena, :elektricni, :broj_brzina, :velicina_cm, :cijena_kn)
        
        // ');
        // $izraz->execute([
        //     'proizvodac'=>$p['proizvodac'],
        //     'namjena'=>$p['namjena'],
        //     'elektricni'=>$p['elektricni'],
        //     'broj_brzina'=>$p['broj_brzina'],
        //     'velicina_cm'=>$p['velicina_cm'],
        //     'cijena_kn'=>$p['cijena_kn']
        // ]);
        // $sifraBicikl = $veza->lastInsertId();
        // $izraz = $veza->prepare('
        //     insert into stavka (bicikl, kolicina)
        //     values (:bicikl, :kolicina)
        // ');
        // $izraz->execute([
        //     'bicikl'=>$sifraBicikl,
        //     'kolicina'=>$p['kolicina']
        // ]);
        // $sifraStavka = $veza->lastInsertId();
        // $veza->commit();
        // return $sifraStavka;
    }

    public static function update($p)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            select bicikl from stavka where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$p['sifra']
        ]);
        
        $sifraBicikl = $izraz->fetchColumn();

        $izraz = $veza->prepare('
            update bicikl set
            proizvodac=:proizvodac,
            namjena=:namjena,
            elektricni=:elektricni,
            broj_brzina=:broj_brzina,
            velicina_cm=:velicina_cm,
            cijena_kn=:cijena_kn
            where sifra=:sifra
            
        ');

        $izraz->execute([
            'proizvodac'=>$p['proizvodac'],
            'namjena'=>$p['namjena'],
            'elektricni'=>$p['elektricni'],
            'broj_brzina'=>$p['broj_brzina'],
            'velicina_cm'=>$p['velicina_cm'],
            'cijena_kn'=>$p['cijena_kn'],
            'sifra'=>$sifraBicikl
        ]);

        $izraz = $veza->prepare('
            update stavka set
            kolicina=:kolicina
            where sifra=:sifra
        ');
        $izraz->execute([
            'kolicina'=>$p['kolicina'],
            'sifra'=>$p['sifra']
        ]);
        
        $veza->commit();
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

    // public static function dodajbicikl($vrijeme_kupnje, $prodavac, $kupac, $stavka)
    // {
    //     $veza = DB::getInstance();
    //     $izraz = $veza->prepare('
        
    //        insert into racun(vrijeme_kupnje, prodavac, kupac, stavka) values
    //        (:vrijeme_kupnje,:prodavac, :kupac, :stavka)
        
    //     ');
    //     $izraz->execute([
    //         'vrijeme_kupnje'=>$vrijeme_kupnje,
    //         'prodavac'=>$prodavac,
    //         'kupac'=>$kupac,
    //         'stavka'=>$stavka
    //     ]);
    // }

    // public static function obrisibicikl($vrijeme_kupnje, $prodavac, $kupac, $stavka)
    // {
    //     $veza = DB::getInstance();
    //     $izraz = $veza->prepare('
        
    //       delete from racun where vrijeme_kupnje=:vrijeme_kupnje 
    //       and prodavac=:prodavac and kupac=:kupac and stavka=:stavka
        
    //     ');
    //     $izraz->execute([
    //         'vrijeme_kupnje'=>$vrijeme_kupnje,
    //         'prodavac'=>$prodavac,
    //         'kupac'=>$kupac,
    //         'stavka'=>$stavka
    //     ]);
    // }
}