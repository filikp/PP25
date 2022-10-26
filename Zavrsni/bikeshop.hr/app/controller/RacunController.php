<?php

class RacunController extends AutorizacijaController
{
    private $phtmlDir = 'privatno' .
        DIRECTORY_SEPARATOR . 'racun' .
        DIRECTORY_SEPARATOR;
    
    private $entitet;
    private $poruka;

    public function index()
    {
        $racun = Racun::read();
        foreach($racun as $r){
            if($r->vrijeme_kupnje != null &&
                $r->vrijeme_kupnje != '0000-00-00 00:00:00'){
                    $r->vrijeme_kupnje = date('d.m.Y', strtotime($r->vrijeme_kupnje));
                }else{
                    $r->vrijeme_kupnje = 'Nije postavljeno';
                }
        }
        $this->view->render($this->phtmlDir . 'index',[
            'racun' => $racun
        ]);
    }

    public function novi()
    {
        $novi = Racun::create([
            'vrijeme_kupnje'=>'',
            'prodavac'=>'',
            'kupac'=>''
        ]);
        header('location: ' . App::config('url') 
                . 'racun/promjena/' . $novi);
    }

    public function promjena($sifra)
    {
        $prodavaci=$this->ucitajProdavace();
        $kupci=$this->ucitajKupce();

        if(!isset($_POST['ime'])){

            $e = Racun::readOne($sifra);
            //Log::log($e);
            // if($e->vrijeme_kupnje!=null){
            //     $e->vrijeme_kupnje = date('Y-m-d',
            //     strtotime($e->vrijeme_kupnje));
            // }else{
            //     $e->vrijeme_kupnje = '';
            // }
            if($e==null){
                header('location: ' . App::config('url') . 'racun');
            }
           
            $this->detalji($e, $prodavaci, $kupci ,'Unesite podatke');
           
            return;
        }

        $this->entitet = (object) $_POST;
        $this->entitet->sifra=$sifra;
        
    
        
        if($this->kontrola()){
            if($this->entitet->kupac==0){
                $this->entitet->kupac=null;
            }

            Racun::update((array)$this->entitet);
            header('location: ' . App::config('url') . 'racun');
            return;
        }
        
        $this->detalji($this->entitet, $prodavaci, $kupaci, $this->poruka);
 
    }

    private function detalji($e, $prodavaci, $kupci, $poruka)
    {
        $this->view->render($this->phtmlDir . 'detalji',[
            'e'=>$e,
            'prodavaci'=>$prodavaci,
            'kupci'=>$kupci,
            'poruka'=>$poruka,
            'css'=>'<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">',
            'js'=>'<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
            <script>
                let url=\'' .  App::config('url') .  '\';
                let grupa=' . $e->sifra . ';
            </script>
            <script src="'. App::config('url') . 'public/js/detaljiRacuna.js"></script>
            '
        ]);
    }

    private function ucitajProdavace()
    {
        $prodavaci = [];
        $p = new stdClass();
        $p->sifra=0;
        $p->ime='Odaberi Prodavaca';
        $prodavac[]=$p;
        foreach(Prodavac::read() as $prodavac){
            $prodavaci[]=$prodavac;
        }
        return $prodavaci;
    }

    private function ucitajKupce()
    {
        $kupci = [];
        $k = new stdClass();
        $k->sifra=0;
        $k->ime='Odaberi kupca';
        $kupci[]=$k;
        foreach(Kupac::read() as $kupac){
            $kupci[]=$kupac;
        }
        return $kupci;
    }

    public function dodajBicikl()
    {
        if(!isset($_GET['racun']) || !isset($_GET['bicikl'])){
            return;
        }
        Racun::dodajBicikl($_GET['racun'],$_GET['bicikl']);
    }

    public function obrisiBicikl()
    {
        if(!isset($_GET['racun']) || !isset($_GET['bicikl'])){
            return;
        }
        Racun::obrisiBicikl($_GET['racun'],$_GET['bicikl']);
    }
}