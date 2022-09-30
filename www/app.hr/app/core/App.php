<?php

class App
{
    public static function start()
    {
        // echo 'Hello from App::start';
        $ruta = Request::getRuta();

        $dijelovi = explode('/', $ruta);

        //Log::log($dijelovi);

        $klasa='';
        if(!isset($dijelovi[1]) || $dijelovi[1]===''){
            $klasa = 'IndexController';
        }else{
            $klasa = ucfirst($dijelovi[1]) . 'Controller';
        }
        
        //Log::log($klasa);

        $metoda = '';
        if(!isset($dijelovi[2]) || $dijelovi[2]===''){
            $metoda = 'index';
        }else{
            $metoda = $dijelovi[2];
        }
        // Log::log($metoda);

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
            //echo 'Ne postoji ' . $klasa . '-&gt' . $metoda;
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
        $config = require $configFile;
        if(isset($config[$kljuc])){
            return $config[$kljuc];
        }else{
            return 'Ključ' . $kljuc . ' ne postoji u datoteci ' . $configFile;
        }
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

