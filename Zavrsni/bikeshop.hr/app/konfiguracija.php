<?php

$dev = $_SERVER['SERVER_ADDR']=='127.0.0.1';

if($dev){
     return [
          'dev'=>$dev,
          'url'=>'http://bikeshop.hr/',
          'nazivApp'=>'Bike Shop',
          'baza'=>[
               'server'=>'localhost',
               'baza'=>'edunovapp25',
               'korisnik'=>'edunova',
               'lozinka'=>'edunova'
          ]
     ];
}else{
     // PRODUKCIJA
     return [
          'dev'=>$dev,
          'url'=>'https://polaznik13.edunova.hr/',
          'nazivApp'=>'Bike Shop',
          'baza'=>[
               'server'=>'localhost',
               'baza'=>'artemida_edunovapp25',
               'korisnik'=>'artemida_edunova13',
               'lozinka'=>'vckR9-46[q5J'
          ]
     ];
}