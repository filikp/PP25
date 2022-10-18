<?php

class RacunController extends AutorizacijaController
{
    private $phtmlDir = 'privatno' .
        DIRECTORY_SEPARATOR . 'racun' .
        DIRECTORY_SEPARATOR;
    
    private $racun=null;
    private $poruka='';

    public function index()
    {
        $racun = Racun::read();
        $this->view->render($this->phtmlDir . 'read',[
            'racun' => $racun
        ]);
    }
}