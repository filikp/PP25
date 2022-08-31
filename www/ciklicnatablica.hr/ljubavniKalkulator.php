<?php
// Broji koliko se puta pojavljuje koje slovo
function izbrojSlova($prvoIme, $drugoIme)
{
    $zajednoImena = $prvoIme . $drugoIme;
    $zajednoImena = mb_strtolower($zajednoImena); // sva slova pratvara u mala slova
    $brojSlovaRedom = '';
    // razdvaja string u listu s vrijednostima chara
    $chrArray = preg_split('//u', $zajednoImena, -1, PREG_SPLIT_NO_EMPTY);
    //Lista $kolikoImaKojegSlova kojoj su ključevi slova imena, a vrijednosti ključa koliko se puta ponavlja to slovo
    $kolikoImaKojegSlova = array_count_values($chrArray);
    //U brojSlovaRedom se sprema koliko ima kojeg slova, redom kako je i napisano ime
    foreach (mb_str_split($zajednoImena) as $slova){
        foreach($kolikoImaKojegSlova as $key => $value){
            if($slova === $key){
                $brojSlovaRedom .= $value;
            }
        }
    }
    echo $prvoIme, ' i ', $drugoIme, ' se vole ', ljubavniKalkulator($brojSlovaRedom), '%';
}

function ljubavniKalkulator($sve)
{
    $zbroj='';
    while(strlen($sve)>2){
        for($i=0;$i<(int)(strlen($sve)*0.5);$i++){
            $zbroj .= $sve[$i] + $sve[strlen($sve)-$i-1];
        }
        if(strlen($sve)%2!=0){
            $zbroj .= $sve[(int)(strlen($sve)*0.5)];
        }
        return ljubavniKalkulator($zbroj);
    }
    return $sve;
}

izbrojSlova($x, $y);