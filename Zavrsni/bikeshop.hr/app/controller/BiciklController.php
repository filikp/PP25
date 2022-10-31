<?php

class BiciklController extends AutorizacijaController
{
    private $phtmlDir = 'privatno' . 
        DIRECTORY_SEPARATOR . 'bicikl' .
        DIRECTORY_SEPARATOR;

    private $bicikl=null;
    private $poruka='';

    public function index()
    {
        // $nf = new NumberFormatter("hr-HR", \NumberFormatter::DECIMAL);
        // $nf->setPattern('#,##0.00');
        $bicikl = Bicikl::read();
        // foreach($bicikl as $b){
        //     $b->cijena_kn = $nf->format((float)$b->cijena_kn);
        // }

        $this->view->render($this->phtmlDir . 'read',[
            'bicikl' => $bicikl
        ]);
    }

    public function promjena($sifra)
    {
        if(!isset($_POST['proizvodac'])){

            $bicikl = Bicikl::readOne($sifra);
            if($bicikl==null){
                header('location: ' . App::config('url') . 'bicikl');
            }

            $this->view->render($this->phtmlDir . 'update',[
                'bicikl' => $bicikl,
                'poruka' => 'Promijenite podatke'
            ]);
            return;
        }

        $this->bicikl = (object) $_POST;
        $this->bicikl->sifra=$sifra;
        $this->bicikl->elektricni = isset($_POST['elektricni']);

        if($this->kontrolaPromjena()){
            Bicikl::update((array)$this->bicikl);
            header('location: ' . App::config('url') . 'bicikl');
            return;
        }

        $this->view->render($this->phtmlDir . 'update',[
            'bicikl'=>$this->bicikl,
            'poruka'=>$this->poruka
        ]);
    }


    public function brisanje($sifra)
    {

        $bicikl = Bicikl::readOne($sifra);
        if($bicikl==null){
            header('location: ' . App::config('url') . 'bicikl');
        }

        if(!isset($_POST['obrisi'])){
            $this->view->render($this->phtmlDir . 'delete',[
                'bicikl' => $bicikl,
                'brisanje' => Bicikl::brisanje($sifra),
                'poruka' => 'Detalji bicikla za brisanje'
            ]);
            return;
        }

        Bicikl::delete($sifra);
        header('location: ' . App::config('url') . 'bicikl');
    }


    public function novi()
    {
        if(!isset($_POST['proizvodac'])){
            // došao s HTTP GET method
            $this->pripremiBicikl();
            $this->view->render($this->phtmlDir . 'create',[
                'bicikl'=>$this->bicikl,
                'poruka'=>'Popunite sve podatke'
            ]);
            return; // short curcuiting
        }
         
        // došao s HTTP POST method
        $this->bicikl = (object) $_POST;
        $this->bicikl->elektricni = isset($_POST['elektricni']);
    
        if($this->kontrolaNovi()){
            Bicikl::create((array)$this->bicikl);
            header('location: ' . App::config('url') . 'bicikl');
            return;
        }

        $this->view->render($this->phtmlDir . 'create',[
            'bicikl'=>$this->bicikl,
            'poruka'=>$this->poruka
        ]);
        
    }
    

    private function kontrolaNovi()
    {
        return $this->kontrolaProizvodac() && $this->kontrolaBrzine()  && $this->kontrolaVelicina() && $this->kontrolaCijena();
    }

    private function kontrolaPromjena()
    {
        return $this->kontrolaProizvodac() && $this->kontrolaBrzine()  && $this->kontrolaVelicina() && $this->kontrolaCijena();
    }

    private function kontrolaProizvodac()
    {
        //Log::log($this->bicikl->proizvodac);
        $this->bicikl->proizvodac=str_replace('&nbsp;',' ',$this->bicikl->proizvodac);
        $this->bicikl->proizvodac=trim($this->bicikl->proizvodac);
        //Log::log($this->bicikl->proizvodac);
        if(strlen($this->bicikl->proizvodac)===0){
            $this->poruka = 'Proizvođač obavezno';
            return false;
        }
        return true;
    }

    private function kontrolaCijena()
    {
        $broj = (float)$this->bicikl->cijena_kn;
        if($broj<=0){
            $this->poruka='Cijena mora biti veća od nule';
            $this->bicikl->cijena_kn=$broj;
            return false;
        }
        return true;
    }

    private function kontrolaVelicina()
    {
        $broj = (float)$this->bicikl->velicina_cm;
        if($broj<=0){
            $this->poruka='Veličina mora biti veća od nule';
            $this->bicikl->velicina_cm=$broj;
            return false;
        }
        return true;
    }

    private function kontrolaBrzine()
    {
        $broj = (float)$this->bicikl->broj_brzina;
        if($broj<=0){
            $this->poruka='Broj brzina mora biti veća od nule';
            $this->bicikl->broj_brzina=$broj;
            return false;
        }
        return true;
    }

    private function pripremiBicikl()
    {
        $this->bicikl=new stdClass();
        $this->bicikl->proizvodac='';
        $this->bicikl->namjena='';
        $this->bicikl->elektricni=false;
        $this->bicikl->broj_brzina='';
        $this->bicikl->velicina_cm='';
        $this->bicikl->cijena_kn='';
    }

}