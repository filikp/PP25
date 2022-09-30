<?php

class SmjerController extends AutorizacijaController
{

    private $phtmlDir = 'privatno' . 
        DIRECTORY_SEPARATOR . 'smjerovi' . 
        DIRECTORY_SEPARATOR;

    public function index()
    {
        $this->view->render($this->phtmlDir . 'read', [
            'smjerovi' => Smjer::read()
        ]);
    }
}

public function promjena($sifra)
{
    $this->view->render($this->phtmlDir . 'update', [
        'smjer' => $sifra
    ]);
}