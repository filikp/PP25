<?php

class DijagramController extends Controller
{
    public function index()
    {
        $this->view->render('privatno' . DIRECTORY_SEPARATOR . 'dijagram');
    }
}