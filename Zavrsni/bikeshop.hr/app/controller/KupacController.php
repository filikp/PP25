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

    private function pripremiKupac()
    {
        $this->kupac=new stdClass();
        $this->kupac->ime='';
        $this->kupac->prezime='';
        $this->kupac->mobitel='';
    }
}