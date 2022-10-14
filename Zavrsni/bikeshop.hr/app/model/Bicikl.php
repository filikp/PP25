<?php

class Bicikl
{

    public static function brisanje($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            select count(*) from bicikl where sifra=:sifra
        
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
        
            select * from bicikl order by proizvodac
        
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
        $izraz->execute($bicikl);
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