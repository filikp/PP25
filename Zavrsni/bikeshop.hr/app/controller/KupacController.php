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
}