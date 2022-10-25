<?php

class ProdavacController extends AutorizacijaController
{
    private $phtmlDir = 'privatno' .
        DIRECTORY_SEPARATOR . 'prodavaci' .
        DIRECTORY_SEPARATOR;
    
    private $prodavac=null;
    private $poruka='';

    public function index()
    {
        $prodavaci = Prodavac::read();
        $this->view->render($this->phtmlDir . 'read',[
            'prodavac' => $prodavaci
        ]);
    }

    public function promjena($sifra)
    {
        if(!isset($_POST['ime'])){

            $prodavac = Prodavac::readOne($sifra);
            if($prodavac==null){
                header('location: ' . App::config('url') . 'prodavac');
            }

            $this->view->render($this->phtmlDir . 'update',[
                'prodavac' => $prodavac,
                'poruka' => 'Promijenite podatke'
            ]);
            return;
        }

        $this->prodavac = (object) $_POST;
        $this->prodavac->sifra=$sifra;

        if($this->kontrolaPromjena()){
            Prodavac::update((array)$this->prodavac);
            header('location: ' . App::config('url') . 'prodavac');
            return;
        }

        $this->view->render($this->phtmlDir . 'update',[
            'prodavac'=>$this->prodavac,
            'poruka'=>$this->poruka
        ]);
    }

    public function brisanje($sifra)
    {

        $prodavac = Prodavac::readOne($sifra);
        if($prodavac==null){
            header('location: ' . App::config('url') . 'prodavac');
        }

        if(!isset($_POST['obrisi'])){
            $this->view->render($this->phtmlDir . 'delete',[
                'prodavac' => $prodavac,
                'brisanje' => Prodavac::brisanje($sifra),
                'poruka' => 'Detalji prodavača za brisanje'
            ]);
            return;
        }

        Prodavac::delete($sifra);
        header('location: ' . App::config('url') . 'prodavac');
    }

    public function novi()
    {
        if(!isset($_POST['ime'])){
            $this->pripremiProdavac();
            $this->view->render($this->phtmlDir . 'create',[
                'prodavac'=>$this->prodavac,
                'poruka'=>'Popunite sve podatke'
            ]);
            return;
        }
         
        $this->prodavac = (object) $_POST;
    
        if($this->kontrolaNovi()){
            Prodavac::create((array)$this->prodavac);
            header('location: ' . App::config('url') . 'prodavac');
            return;
        }

        $this->view->render($this->phtmlDir . 'create',[
            'prodavac'=>$this->prodavac,
            'poruka'=>$this->poruka
        ]);
        
    }

    private function kontrolaNovi()
    {
        return $this->kontrolaIme() && $this->kontrolaPrezime();
    }

    private function kontrolaPromjena()
    {
        return $this->kontrolaOIB() && $this->kontrolaIBAN() && $this->kontrolaIme() && $this->kontrolaPrezime();
    }

    private function kontrolaOIB()
    {
        $oib = (int)$this->prodavac->OIB;
        if(strlen($oib)===11 || $oib==null){
            return true;
        }
        $this->poruka = 'OIB mora imati 11 znamenki';
        $this->prodavac->OIB=null;
        return false;
    }

    private function kontrolaIBAN()
    {
        $iban = $this->prodavac->IBAN;
        if(strlen($iban)==21 ||  $iban==null || (str_starts_with($iban, 'HR'))){ //još implementirati da provjerava jesu li znamenke
            
            return true;
        }
        $this->poruka = 'IBAN mora početi sa HR imati 19 znamenki';
        $this->prodavac->IBAN=null;
        return false;
    }

    private function kontrolaIme()
    {
        $this->prodavac->ime=str_replace('&nbsp;',' ',$this->prodavac->ime);
        $this->prodavac->ime=trim($this->prodavac->ime);
       // Log::log($this->prodavac->ime);
        if(strlen($this->prodavac->ime)===0){
            $this->poruka = 'Ime obavezno';
            return false;
        }
        return true;
    }

    private function kontrolaPrezime()
    {
        $this->prodavac->prezime=str_replace('&nbsp;',' ',$this->prodavac->prezime);
        $this->prodavac->prezime=trim($this->prodavac->prezime);
       // Log::log($this->prodavac->prezime);
        if(strlen($this->prodavac->prezime)===0){
            $this->poruka = 'Prezime obavezno';
            return false;
        }
        return true;
    }

    private function pripremiProdavac()
    {
        $this->prodavac=new stdClass();
        $this->prodavac->ime='';
        $this->prodavac->prezime='';
        $this->prodavac->email='';
        $this->prodavac->OIB='';
        $this->prodavac->IBAN='';
    }
}