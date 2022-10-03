<?php

$dev = $_SERVER['SERVER_ADDR']=='127.0.0.1';

if($dev){
     return [
          'dev'=>$dev,
          'url'=>'http://bikeshop.hr/',
          'nazivApp'=>'Bike Shop',
          'baza'=>[
               'server'=>'localhost',
               'baza'=>'trgovina_bicikala',
               'korisnik'=>'bikeshop',
               'lozinka'=>'bikeshop'
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
               'baza'=>'artemida_bikeshop',
               'korisnik'=>'artemida_bikeshop',
               'lozinka'=>'@oMP0%AF{gjg'
          ]
     ];
}