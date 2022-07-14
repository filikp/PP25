<?php
function izbrojSlova($tekst)
{
    foreach(count_chars($tekst, 1) as $i => $vrijednost){
        $popis[chr($i)] = $vrijednost; 
    }
    echo '<pre>';
    print_r($popis);
    echo '</pre>';
}
$x = 'Sir ima miris';
izbrojSlova($x);



