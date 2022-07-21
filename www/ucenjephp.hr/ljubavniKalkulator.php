<?php
// Broji koliko se puta pojavljuje koje slovo
function izbrojSlova($prvoIme, $drugoIme)
{
    $zajednoImena = $prvoIme . $drugoIme;
    $brojSlova = []; //prazna lista u kojoj se redom sprema koliko ima kojeg slova (lista je dugačka koliko i riječ)
    //Lista kolikoImaSlova kojoj su ključevi slova imena, a vrijednosti ključa koliko se puta ponavlja to slovo
    foreach(count_chars($zajednoImena, 1) as $i => $vrijednost){
        $kolikoImaSlova[chr($i)] = $vrijednost; 
    }
    //U brojSlova se sprema koliko ima kojeg slova, redom kako je i napisano ime
    foreach (mb_str_split($zajednoImena) as $slova) {
        foreach($kolikoImaSlova as $key => $value){
            if($slova === $key){
                $brojSlova[] = $value;
            }
        }
    }
    echo '<pre>';
    print_r($kolikoImaSlova);
    print_r($brojSlova);
    echo '</pre>';
    return $brojSlova;
}
$x = 'Miroslav';
$y = 'Zorin';
izbrojSlova($x, $y);

function ljubavniKalkulator($prvoIme, $drugoIme)
{
    $x = izbrojSlova($prvoIme); // dobijem listu koliko ima kojeg slova redom s ponavljanjem
    $y = izbrojSlova($drugoIme); // dobijem listu koliko ima kojeg slova redom s ponavljanjem
    // $max = count($x);
    // if(count($y)>count($x)){
    //     $max = count($y);
    // }
    $spojenoX = implode('',$x); // spaja niz u string bez razmaka
    $spojenoY = implode('',$y); // spaja niz u string bez razmaka
    $spojenoSve = $spojenoX . $spojenoY;
    $zbrajanjeDvaBroja = '';
    // for($i=0;$i<$max;$i++){
    //     $suma = 0;
    //     $suma = $x[$i]+$y[$i];
    //     $zbrajanjeDvaBroja = $zbrajanjeDvaBroja . $suma; 
    // }
    echo zbrojiPrviIZadnji($spojenoSve);
    
    // echo $zbrajanjeDvaBroja;
    // echo '<pre>';
    // print_r($x);
    // print_r($y);
    // echo '</pre>';
    // echo $spojenoSve, '<br>';
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



