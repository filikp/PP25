<?php

class App{
    public static function start()
    {
        $ruta = Request::getRuta();

        $dijelovi = explode('/', $ruta);

        $klasa = '';
        if(!isset($dijelovi[1]) || $dijelovi[1]===''){
            $klasa = 'IndexController';
        }else{
            $klasa = ucfirst($dijelovi[1]) . 'Controller';
        }

        $metoda = '';
        if(!isset($dijelovi[2]) || $dijelovi[2]===''){
            $metoda = 'index';
        }else{
            $metoda = $dijelovi[2];
        }

        $parametar = '';
        if(!isset($dijelovi[3]) || $dijelovi[3]===''){
            $parametar = '';
        }else{
            $parametar = $dijelovi[3];
        }

        if(class_exists($klasa) && method_exists($klasa, $metoda)){
            $instanca = new $klasa();
            if(strlen($parametar)>0){
                $instanca->$metoda($parametar);
            }else{
                $instanca->$metoda();
            }
        }else{
            $view = new View();
            $view->render('errorKlasaMetoda',[
                'klasa'=>$klasa,
                'metoda'=>$metoda
            ]);
        }
    }
    
    public static function config($kljuc)
    {
        $configFile = BP_APP . 'konfiguracija.php';
        if(!file_exists($configFile)){
            return 'Datoteka ' . $configFile . ' ne postoji. Kreirajte ju';
        }
        $config = require $configFile;
        if(isset($config[$kljuc])){
            return $config[$kljuc];
        }

        return 'Ključ ' . $kljuc . ' ne postoji u datoteci ' .  $configFile;
   
    }

    public static function auth()
    {
        if(!isset($_SESSION)){
            return false;
        }

        if(!isset($_SESSION['autoriziran'])){
            return false;
        }

        return true;
    }

    public static function user()
    {
        return $_SESSION['autoriziran'];
    }
}