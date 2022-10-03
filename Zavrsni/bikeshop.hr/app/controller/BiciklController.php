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
        $nf = new NumberFormatter("hr-HR", \NumberFormatter::DECIMAL);
        $bicikl = Bicikl::read();
        foreach($bicikl as $b){
            $b->cijena_kn = $nf->format($b->cijena_kn);
        }

        $this->view->render($this->phtmlDir . 'read',[
            'bicikl' => $bicikl
        ]);
    }
}