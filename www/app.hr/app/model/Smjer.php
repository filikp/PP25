<?php

class Smjer
{
    // CRUD - R
    public static function read()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('

            select * from smjer

        ');

        $izraz->execute(); //Ovo mora biti obavezno
        return $izraz->fetchAll(); // Vraća indeksni niz objekata tipa stdClass
    }

    // CRUD - C
    public static function create()
    {
        
    }

    // CRUD - U
    public static function update()
    {
        
    }

    // CRUD - D
    public static function delete()
    {
        
    }
}
