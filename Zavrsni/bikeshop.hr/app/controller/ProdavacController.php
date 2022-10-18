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
        $prodavaci = Prodavaci::read();
        $this->view->render($this->phtmlDir . 'read',[
            'prodavaci' => $prodavaci
        ]);
    }
}