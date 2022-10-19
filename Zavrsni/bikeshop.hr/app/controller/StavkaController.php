<?php

class StavkaController extends AutorizacijaController
{
    private $phtmlDir = 'privatno' .
        DIRECTORY_SEPARATOR . 'stavka' .
        DIRECTORY_SEPARATOR;
    
    private $stavka=null;
    private $poruka='';

    public function index()
    {
        $this->view->render($this->phtmlDir . 'index',[
            'stavka'=>Stavka::read()
        ]);
    }
}