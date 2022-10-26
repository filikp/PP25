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

        $racun = $izraz->fetch();
        if($racun->vrijeme_kupnje=='0000-00-00 00:00:00'){
            $racun->vrijeme_kupnje=null;
        }
        $izraz = $veza->prepare('
            select a.sifra, a.proizvodac, a.cijena_kn
            from bicikl a inner join stavka b 
            on a.sifra = b.bicikl
            where b.racun=:sifra
        ');

        $izraz->execute([
            'sifra'=>$sifra
        ]);

        $racun->bicikl = $izraz->fetchAll();

        return $racun;

        // $veza = DB::getInstance();
        // $izraz = $veza->prepare('
        
        // select concat(p.ime, \' \', p.prezime) as prodavac, r.vrijeme_kupnje,
        // concat(k.ime, \' \', k.prezime) as kupac, k.mobitel, b.proizvodac, b.cijena_kn, s.kolicina
        // from prodavac p inner join racun r 
        // on p.sifra = r.prodavac  
        // inner join kupac k
        // on k.sifra = r.kupac 
        // inner join stavka s 
        // on s.sifra = r.stavka 
        // inner join bicikl b 
        // on b.sifra = s.bicikl
        // where b.sifra=:sifra

        // ');
        // $izraz->execute([
        //     'sifra'=>$sifra
        // ]);
        // return $izraz->fetch();
    }

    // CRUD - R
    public static function read()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        select a.sifra, a.vrijeme_kupnje, concat(b.ime, \' \', b.prezime) as prodavac, e.kolicina, d.elektricni,
        d.cijena_kn,
		concat(c.ime, \' \', c.prezime) as kupac, concat(d.proizvodac, \' (\', d.namjena,\')\') as bicikl,
		count(e.bicikl) as bicikli
        from racun a inner join prodavac b 
        on a.prodavac = b.sifra 
        left join kupac c  
        on a.kupac = c.sifra
        left join stavka e  
        on a.sifra = e.racun 
        left join bicikl d 
        on d.sifra = e.bicikl
        group by a.sifra, a.vrijeme_kupnje, concat(b.ime, \' \', b.prezime), 
		concat(c.ime, \' \', c.prezime), concat(d.proizvodac, \' \', d.namjena);


        
        ');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function create($p)
    {

        $veza = DB::getInstance();
        $izraz = $veza->prepare('
            insert into racun
            (vrijeme_kupnje, prodavac, kupac)
            values
            (:vrijeme_kupnje, :prodavac, :kupac);
        ');

        $izraz->execute($p);
        return $veza->lastInsertId();
    }

    public static function update($p)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        update racun set
            vrijeme_kupnje=:vrijeme_kupnje,
            prodavac=:prodavac,
            kupac=:kupac,
        where sifra=:sifra;
        
        ');
        $izraz->execute($p);
    }

    public static function delete($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
           delete from racun where sifra=:sifra 
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
    }

    public static function dodajBicikl($bicikl, $kolicina, $racun)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
           insert into stavka(bicikl, kolicina, racun) values
           (:bicikl, :kolicina, :racun)
        
        ');
        $izraz->execute([
            'bicikl'=>$bicikl,
            'kolicina'=>$kolicina,
            'racun'=>$racun
        ]);
    }

    public static function obrisiBicikl($racun,$bicikl)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
          delete from stavka where bicikl=:bicikl 
          and racun=:racun
        
        ');
        $izraz->execute([
            'bicikl'=>$bicikl,
            'racun'=>$racun
        ]);
    }
}