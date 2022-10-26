<?php

class Bicikl
{

    public static function brisanje($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            select count(*) from stavka where bicikl=:sifra
        
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
        
            select * from bicikl where sifra=:sifra
        
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
        
            select a.sifra, a.proizvodac, a.namjena, a.elektricni, a.broj_brzina, a.velicina_cm, a.cijena_kn, count(b.sifra) as racuna 
            from bicikl a left join stavka b
            on a.sifra = b.bicikl
            group by a.sifra, a.proizvodac, a.namjena, a.elektricni, a.broj_brzina, a.velicina_cm, a.cijena_kn
            order by 1,2;
        
        ');
        $izraz->execute(); // OVO MORA BITI OBAVEZNO
        return $izraz->fetchAll(); // vraća indeksni niz objekata tipa stdClass
    }

    // CRUD - C
    public static function create($bicikl)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        insert into 
        bicikl (proizvodac, namjena, elektricni, broj_brzina, velicina_cm, cijena_kn)
        values (:proizvodac, :namjena, :elektricni, :broj_brzina, :velicina_cm, :cijena_kn)
        
        ');
        $izraz->execute([
            'proizvodac'=>$bicikl['proizvodac'],
            'namjena'=>$bicikl['namjena'],
            'elektricni'=>$bicikl['elektricni'],
            'broj_brzina'=>$bicikl['broj_brzina'],
            'velicina_cm'=>$bicikl['velicina_cm'],
            'cijena_kn'=>$bicikl['cijena_kn'],
        ]);
    }

    // CRUD - U
    public static function update($bicikl)
    {
        $veza = DB::getInstance();
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
        $izraz->execute($bicikl);
    }

    // CRUD - D
    public static function delete($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            delete from bicikl where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
    }


}