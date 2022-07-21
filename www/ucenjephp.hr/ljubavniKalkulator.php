<?php
// Broji koliko se puta pojavljuje koje slovo
function izbrojSlova($prvoIme, $drugoIme)
{
    $zajednoImena = $prvoIme . $drugoIme;
    $brojSlovaRedom = []; //prazna lista u kojoj se redom sprema koliko ima kojeg slova (lista je dugačka koliko i riječ)
    //Lista KolikoI$kolikoImaKojegSlova kojoj su ključevi slova imena, a vrijednosti ključa koliko se puta ponavlja to slovo
    foreach(count_chars($zajednoImena, 1) as $i => $vrijednost){
        $kolikoImaKojegSlova[chr($i)] = $vrijednost; 
    }
    //U brojSlova se sprema koliko ima kojeg slova, redom kako je i napisano ime
    foreach (mb_str_split($zajednoImena) as $slova) {
        foreach($kolikoImaKojegSlova as $key => $value){
            if($slova === $key){
                $brojSlovaRedom[] = $value;
            }
        }
    }
    // echo '<pre>';
    // print_r($kolikoImaKojegSlova);
    // print_r($brojSlovaRedom);
    // echo '</pre>';
    return $brojSlovaRedom;
}
$x = 'Miroslav';
$y = 'Kupusa';
izbrojSlova($x, $y);

function ljubavniKalkulator($prvoIme, $drugoIme)
{
    $sve = izbrojSlova($prvoIme, $drugoIme); // dobijem listu koliko ima kojeg slova redom s ponavljanjem
    $konacno = '';
    // Treba mi najkraća riječ
    $min = strlen($prvoIme); 
    if(strlen($drugoIme)<strlen($prvoIme)){
        $min = strlen($drugoIme);
    }
    $duljina = count($sve); // Duljina obje riječi
    for($i=1;$i<=$min;$i++){
        $konacno = $konacno . ($sve[$i-1]+$sve[$duljina-$i]);
        unset($sve[$i-1]);
        unset($sve[$duljina-$i]);
    }
    echo '<pre>';
    print_r($sve);
    echo '</pre>';
    if($drugoIme>$prvoIme){
        $spojeno = strrev(implode('',$sve)); // spaja niz u string i okreće ga
    }else{
        $spojeno = implode('',$sve); // spaja niz u string
    }
    $konacno = $konacno . $spojeno; // Dodaje ostatak brojeva koji se nemaju s čim zbrojiti
    echo $konacno, '<br>';
    echo zbrojiPrviIZadnji($konacno);
}

function zbrojiPrviIZadnji($broj)
{
    if(strlen($broj)==2 || strlen($broj)==1){
        return $broj;
    }else{
        $zbrajanjeDvaBroja = '';
        for($i=1;$i<=((int)(strlen($broj)*0.5));$i++){
            $zbrajanjeDvaBroja = $zbrajanjeDvaBroja . ($broj[$i-1] + $broj[strlen($broj)-$i]);
        }
        //echo $zbrajanjeDvaBroja, '<br>';
        //echo strlen($broj), '<br>';
        if((strlen($broj))%2!=0){
            $zbrajanjeDvaBroja = $zbrajanjeDvaBroja . $broj[(int)(strlen($broj)*0.5)];
        }
        //echo $zbrajanjeDvaBroja, '<br>';
        return zbrojiPrviIZadnji($zbrajanjeDvaBroja);
    }
}

ljubavniKalkulator($x,$y);



