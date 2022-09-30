<?php

class NadzornaPlocaController extends AutorizacijaController
{
    public function index()
    {
        $this->view->render('privatno' . DIRECTORY_SEPARATOR .
                            'nadzornaploca');
    }
}