<?php
function izbrojSlova($ime)
{
    $brojSlova = [];
    foreach(count_chars($ime, 1) as $i => $vrijednost){
        $kolikoImaSlova[chr($i)] = $vrijednost; 
    }
    foreach (mb_str_split($ime) as $slova) {
        foreach($kolikoImaSlova as $key => $value){
            if($slova === $key){
                $brojSlova[] = $value;
            }
        }
    }
    // echo '<pre>';
    // print_r($kolikoImaSlova);
    // print_r($brojSlova);
    // echo '</pre>';
    return $brojSlova;
}
$x = 'Filip';
$y = 'Laura';
izbrojSlova($x);

function ljubavniKalkulator($prvoIme, $drugoIme)
{
    $x = izbrojSlova($prvoIme);
    $y = izbrojSlova($drugoIme);
    echo '<pre>';
    print_r($x);
    print_r($y);
    echo '</pre>';
}

ljubavniKalkulator($x,$y);

