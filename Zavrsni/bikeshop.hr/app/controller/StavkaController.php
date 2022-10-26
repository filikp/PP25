<?php

class StavkaController extends AutorizacijaController
{
    private $phtmlDir = 'privatno' .
        DIRECTORY_SEPARATOR . 'stavka' .
        DIRECTORY_SEPARATOR;
    
    private $stavka=null;
    private $poruka='';
    private $entitet;

    public function index()
    {
        $this->view->render($this->phtmlDir . 'index',[
            'stavka'=>Stavka::read()
        ]);
    }

    public function nova()
    {
        $novaStavka = Stavka::create([
            'bicikl'=>'',
            'kolicina'=>1
        ]);
        header('location: ' . App::config('url') 
                . 'stavka/promjena/' . $novaStavka);
    }

    public function promjena($sifra)
    {
        if(!isset($_POST['ime'])){

            $stavka = Stavka::readOne($sifra);
            if($stavka==null){
                header('location: ' . App::config('url') . 'stavka');
            }

            $this->view->render($this->phtmlDir . 'update',[
                'stavka' => $stavka,
                'poruka' => 'Promijenite podatke'
            ]);
            return;
        }

        $this->stavka = (object) $_POST;
        $this->stavka->sifra=$sifra;

        if($this->kontrolaKolicina()){
            Stavka::update((array)$this->stavka);
            header('location: ' . App::config('url') . 'stavka');
            return;
        }

        $this->view->render($this->phtmlDir . 'update',[
            'stavka'=>$this->stavka,
            'poruka'=>$this->poruka
        ]);
    }

    public function kontrolaKolicina()
    {
        $kolicina = $this->stavka->kolicina;
        if($kolicina<1){
            return false;
        }
    }

    // public function promjena($sifra)
    // {
    //     if(!isset($_POST['bicikl'])){

    //         $e = Stavka::readOne($sifra);
    //         if($e==null){
    //             header('loaction: ' . App::config('url') . 'stavka');
    //         }

    //         $this->view->render($this->phtmlDir . 'detalji', [
    //             'e' => $e,
    //             'poruka' => 'Unesite podatke'
    //         ]);
    //         return;
    //     }

    //     $this->entitet = (object) $_POST;
    //     $this->entitet->sifra=$sifra;

    //     $this->view->render($this->phtmlDir . 'detalji',[
    //         'e' => $e,
    //         'poruka' => 'Unesite podatke'
    //     ]);
    // }

}