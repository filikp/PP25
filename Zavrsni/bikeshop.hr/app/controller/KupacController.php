<?php

class KupacController extends AutorizacijaController
{
    private $phtmlDir = 'privatno' .
        DIRECTORY_SEPARATOR . 'kupci' .
        DIRECTORY_SEPARATOR;
    
    private $kupac=null;
    private $poruka='';

    public function index()
    {
        $kupci = Kupci::read();
        $this->view->render($this->phtmlDir . 'read',[
            'kupci' => $kupci
        ]);
    }

    public function promjena($sifra)
    {
        if(!isset($_POST['ime'])){

            $kupac = Kupci::readOne($sifra);
            if($kupac==null){
                header('location: ' . App::config('url') . 'kupac');
            }

            $this->view->render($this->phtmlDir . 'update',[
                'kupac' => $kupac,
                'poruka' => 'Promijenite podatke'
            ]);
            return;
        }

        $this->kupac = (object) $_POST;
        $this->kupac->sifra=$sifra;

        if($this->kontrolaPromjena()){
            Kupci::update((array)$this->kupac);
            header('location: ' . App::config('url') . 'kupac');
            return;
        }

        $this->view->render($this->phtmlDir . 'update',[
            'kupac'=>$this->kupac,
            'poruka'=>$this->poruka
        ]);
    }

    public function brisanje($sifra)
    {

        $kupac = Kupci::readOne($sifra);
        if($kupac==null){
            header('location: ' . App::config('url') . 'kupac');
        }

        if(!isset($_POST['obrisi'])){
            $this->view->render($this->phtmlDir . 'delete',[
                'kupac' => $kupac,
                'brisanje' => Kupci::brisanje($sifra),
                'poruka' => 'Detalji kupca za brisanje'
            ]);
            return;
        }

        Kupci::delete($sifra);
        header('location: ' . App::config('url') . 'kupac');
    }

    public function novi()
    {
        if(!isset($_POST['ime'])){
            $this->pripremiKupac();
            $this->view->render($this->phtmlDir . 'create',[
                'kupac'=>$this->kupac,
                'poruka'=>'Popunite sve podatke'
            ]);
            return;
        }
         
        $this->kupac = (object) $_POST;
    
        if($this->kontrolaNovi()){
            Kupci::create((array)$this->kupac);
            header('location: ' . App::config('url') . 'kupac');
            return;
        }

        $this->view->render($this->phtmlDir . 'create',[
            'kupac'=>$this->kupac,
            'poruka'=>$this->poruka
        ]);
    }

    private function kontrolaNovi()
    {
        return $this->kontrolaIme() && $this->kontrolaPrezime();
    }

    private function kontrolaIme()
    {
        $this->kupac->ime=str_replace('&nbsp;',' ',$this->kupac->ime);
        $this->kupac->ime=trim($this->kupac->ime);
       // Log::log($this->kupac->ime);
        if(strlen($this->kupac->ime)===0){
            $this->poruka = 'Ime obavezno';
            return false;
        }
        return true;
    }

    private function kontrolaPrezime()
    {
        $this->kupac->prezime=str_replace('&nbsp;',' ',$this->kupac->prezime);
        $this->kupac->prezime=trim($this->kupac->prezime);
       // Log::log($this->kupac->prezime);
        if(strlen($this->kupac->prezime)===0){
            $this->poruka = 'Prezime obavezno';
            return false;
        }
        return true;
    }

    private function kontrolaPromjena()
    {
        return $this->kontrolaIme() && $this->kontrolaPrezime();
    }

    private function pripremiKupac()
    {
        $this->kupac=new stdClass();
        $this->kupac->ime='';
        $this->kupac->prezime='';
        $this->kupac->mobitel='';
    }
}