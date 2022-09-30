<?php

abstract class AutorizacijaController extends Controller
{
    public function __construct()
    {
       parent::__construct();
       if(!isset($_SESSION['autoriziran'])){
            $this->view->render('prijava',[
                'email'=>'',
                'poruka'=>'Prvo se prijavite'
            ]);
       }

    }
}